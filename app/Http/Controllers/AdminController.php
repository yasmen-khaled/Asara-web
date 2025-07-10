<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Cottage;
use App\Models\Review;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\BookingRequest;

class AdminController extends Controller
{
    public function dashboard()
    {
        $customers = Customer::with(['bookingRequests' => function($q) {
            $q->latest();
        }])->latest()->get();
        
        $reviews = \App\Models\Review::with('cottage')->latest()->get();
        
        // Calculate revenue based on booking days and average cottage price
        $totalRevenue = 0;
        $monthlyRevenue = 0;
        $averageCottagePrice = Cottage::avg('price') ?: 200; // Default to 200 if no cottages
        
        $bookingRequests = \App\Models\BookingRequest::all();
        
        foreach ($bookingRequests as $booking) {
            // Calculate number of days
            $checkin = \Carbon\Carbon::parse($booking->checkin);
            $checkout = \Carbon\Carbon::parse($booking->checkout);
            $days = $checkin->diffInDays($checkout);
            
            // Calculate revenue for this booking (days * average price)
            $bookingRevenue = $days * $averageCottagePrice;
            $totalRevenue += $bookingRevenue;
            
            // Calculate monthly revenue
            if ($booking->created_at->month === now()->month) {
                $monthlyRevenue += $bookingRevenue;
            }
        }
        
        $stats = [
            'total_cottages' => Cottage::count(),
            'featured_cottages' => Cottage::where('featured', true)->count(),
            'total_bookings' => \App\Models\BookingRequest::count(),
            'pending_bookings' => \App\Models\BookingRequest::where('status', 'pending')->count(),
            'total_revenue' => $totalRevenue,
            'total_customers' => \App\Models\Customer::count(),
            'total_reviews' => \App\Models\Review::count(),
            'average_rating' => \App\Models\Review::avg('rating') ?: 0,
            'monthly_bookings' => \App\Models\BookingRequest::whereMonth('created_at', now()->month)->count(),
            'monthly_revenue' => $monthlyRevenue
        ];
        
        $cottages = Cottage::orderBy('featured', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->get();
        
        $recent_bookings = \App\Models\BookingRequest::with('customer')
                                 ->orderBy('created_at', 'desc')
                                 ->limit(5)
                                 ->get();

        return view('admin.dashboard', compact('customers', 'stats', 'cottages', 'recent_bookings', 'reviews'));
    }

    public function getCottages()
    {
        $cottages = Cottage::orderBy('featured', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->get();
        return response()->json($cottages);
    }

    public function storeCottage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'featured' => 'boolean',
            'bedrooms' => 'nullable|integer|min:1',
            'bathrooms' => 'nullable|integer|min:1',
            'max_guests' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500'
        ]);

        $cottage = new Cottage();
        $cottage->name = $request->name;
        $cottage->price = $request->price;
        $cottage->description = $request->description;
        $cottage->featured = $request->input('featured') == '1';
        $cottage->bedrooms = $request->bedrooms ?? 1;
        $cottage->bathrooms = $request->bathrooms ?? 1;
        $cottage->max_guests = $request->max_guests ?? 4;
        $cottage->location = $request->location;
        $cottage->address = $request->address;
        $cottage->features = $request->features ?? [];

        // Handle cover image
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = 'r' . time() . '.' . $cover->extension();
            $cover->move(public_path('images'), $coverName);
            $cottage->cover_image = $coverName;
        }

        $cottage->save();

        // Handle additional images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = 'cottage_' . $cottage->id . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/room/cottage' . $cottage->id), $imageName);
                $images[] = 'room/cottage' . $cottage->id . '/' . $imageName;
            }
            $cottage->images = $images;
        }

        $cottage->save();

        return response()->json(['success' => true, 'cottage' => $cottage]);
    }

    public function updateCottage(Request $request, $id)
    {
        $cottage = Cottage::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|array',
            'featured' => 'boolean',
            'bedrooms' => 'nullable|integer|min:1',
            'bathrooms' => 'nullable|integer|min:1',
            'max_guests' => 'nullable|integer|min:1',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500'
        ]);

        $cottage->name = $request->name;
        $cottage->price = $request->price;
        $cottage->description = $request->description;
        $cottage->featured = $request->input('featured') == '1';
        $cottage->bedrooms = $request->bedrooms ?? 1;
        $cottage->bathrooms = $request->bathrooms ?? 1;
        $cottage->max_guests = $request->max_guests ?? 4;
        $cottage->location = $request->location;
        $cottage->address = $request->address;
        $cottage->features = $request->features ?? $cottage->features;

        // Handle cover image update
        if ($request->hasFile('cover')) {
            // Delete old cover image
            if ($cottage->cover_image && file_exists(public_path('images/' . $cottage->cover_image))) {
                unlink(public_path('images/' . $cottage->cover_image));
            }
            
            $cover = $request->file('cover');
            $coverName = 'r' . $id . '_' . time() . '.' . $cover->extension();
            $cover->move(public_path('images'), $coverName);
            $cottage->cover_image = $coverName;
        }

        // Handle additional images
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $imageName = 'cottage_' . $id . '_' . uniqid() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/room/cottage' . $id), $imageName);
                $images[] = 'room/cottage' . $id . '/' . $imageName;
            }
            $cottage->images = $images;
        }

        $cottage->save();

        return response()->json(['success' => true, 'cottage' => $cottage]);
    }

    public function deleteCottage($id)
    {
        $cottage = Cottage::findOrFail($id);

        // Delete cover image
        if ($cottage->cover_image && file_exists(public_path('images/' . $cottage->cover_image))) {
            unlink(public_path('images/' . $cottage->cover_image));
        }

        // Delete cottage images directory
        $cottageImagesDir = public_path('images/room/cottage' . $id);
        if (file_exists($cottageImagesDir)) {
            array_map('unlink', glob("$cottageImagesDir/*.*"));
            rmdir($cottageImagesDir);
        }

        $cottage->delete();

        return response()->json(['success' => true]);
    }



    public function storeBookingRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'guests' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $customer = Customer::firstOrCreate(
            ['phone' => $request->phone],
            ['name' => $request->name]
        );

        BookingRequest::create([
            'customer_id' => $customer->id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'guests' => $request->guests,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true]);
    }

    public function storeReview(Request $request)
    {
        try {
            $request->validate([
                'cottage_id' => 'required|exists:cottages,id',
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|email|max:255',
                'rating' => 'required|integer|between:1,5',
                'review_text' => 'required|string|min:1'
            ]);

            $review = new Review();
            $review->cottage_id = $request->cottage_id;
            $review->guest_name = $request->guest_name;
            $review->guest_email = $request->guest_email;
            $review->rating = $request->rating;
            $review->review_text = $request->review_text;
            $review->stay_date = now();
            $review->ip_address = $request->ip();
            $review->is_approved = true; // Auto-approve reviews for now

            $review->save();

            // Update cottage rating
            $cottage = Cottage::find($request->cottage_id);
            if ($cottage) {
                $cottage->total_reviews = $cottage->reviews()->count();
                $cottage->rating = $cottage->reviews()->avg('rating');
                $cottage->save();
            }

            return response()->json(['success' => true, 'message' => 'تم إضافة التقييم بنجاح']);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حفظ التقييم: ' . $e->getMessage()], 500);
        }
    }

    public function deleteReview($id)
    {
        try {
            $review = \App\Models\Review::findOrFail($id);
            $review->delete();
            return response()->json(['success' => true, 'message' => 'تم حذف التقييم بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حذف التقييم'], 500);
        }
    }

    public function uploadGalleryImages(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $uploadedFiles = [];
        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/moments'), $filename);
            $uploadedFiles[] = $filename;
        }

        return response()->json(['success' => true, 'files' => $uploadedFiles]);
    }

    public function deleteGalleryImage($filename)
    {
        $path = public_path('images/moments/' . $filename);
        if (file_exists($path)) {
            unlink($path);
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'File not found'], 404);
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,webm,avi,mov|max:51200'
        ]);

        $video = $request->file('video');
        $filename = time() . '_' . $video->getClientOriginalName();
        $video->move(public_path('videos'), $filename);

        return response()->json(['success' => true, 'file' => $filename]);
    }

    public function deleteVideo($filename)
    {
        $path = public_path('videos/' . $filename);
        if (file_exists($path)) {
            unlink($path);
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'File not found'], 404);
    }

    public function getStats()
    {
        // Calculate revenue based on booking days and average cottage price
        $totalRevenue = 0;
        $monthlyRevenue = 0;
        $averageCottagePrice = Cottage::avg('price') ?: 200; // Default to 200 if no cottages
        
        $bookingRequests = \App\Models\BookingRequest::all();
        
        foreach ($bookingRequests as $booking) {
            // Calculate number of days
            $checkin = \Carbon\Carbon::parse($booking->checkin);
            $checkout = \Carbon\Carbon::parse($booking->checkout);
            $days = $checkin->diffInDays($checkout);
            
            // Calculate revenue for this booking (days * average price)
            $bookingRevenue = $days * $averageCottagePrice;
            $totalRevenue += $bookingRevenue;
            
            // Calculate monthly revenue
            if ($booking->created_at->month === now()->month) {
                $monthlyRevenue += $bookingRevenue;
            }
        }
        
        $stats = [
            'total_cottages' => Cottage::count(),
            'featured_cottages' => Cottage::where('featured', true)->count(),
            'total_bookings' => \App\Models\BookingRequest::count(),
            'pending_bookings' => \App\Models\BookingRequest::where('status', 'pending')->count(),
            'total_revenue' => $totalRevenue,
            'total_customers' => \App\Models\Customer::count(),
            'total_reviews' => 0, // We'll add reviews functionality later
            'average_rating' => 0,
            'monthly_bookings' => \App\Models\BookingRequest::whereMonth('created_at', now()->month)->count(),
            'monthly_revenue' => $monthlyRevenue
        ];

        return response()->json($stats);
    }

    public function uploadHeroImage(Request $request)
    {
        $request->validate([
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('hero_image');
        $filename = 'cover' . (time() % 1000) . '.' . $image->extension();
        $image->move(public_path('images'), $filename);



        return response()->json(['success' => true, 'file' => $filename]);
    }

    public function deleteHeroImage($filename)
    {
        $path = public_path('images/' . $filename);
        if (file_exists($path)) {
            unlink($path);

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'File not found'], 404);
    }

    public function uploadHeroVideo(Request $request)
    {
        $request->validate([
            'hero_video' => 'required|mimes:mp4,webm|max:51200'
        ]);

        $video = $request->file('hero_video');
        $filename = 'video.mp4';
        $video->move(public_path('images'), $filename);

        return response()->json(['success' => true, 'file' => $filename]);
    }

    public function deleteHeroVideo($filename)
    {
        $path = public_path('images/' . $filename);
        if (file_exists($path)) {
            unlink($path);
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'File not found'], 404);
    }

    public function deleteCustomer($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            
            // Delete all booking requests for this customer first
            $customer->bookingRequests()->delete();
            
            // Delete the customer
            $customer->delete();
            
            return response()->json(['success' => true, 'message' => 'تم حذف العميل بنجاح']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء حذف العميل'], 500);
        }
    }
} 