<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Cottage;
use App\Models\Booking;
use App\Models\Review;

class CottageController extends Controller
{
    private $arabicDays = [
        'Sunday' => 'الأحد',
        'Monday' => 'الاثنين',
        'Tuesday' => 'الثلاثاء',
        'Wednesday' => 'الأربعاء',
        'Thursday' => 'الخميس',
        'Friday' => 'الجمعة',
        'Saturday' => 'السبت'
    ];

    private $arabicMonths = [
        'January' => 'يناير',
        'February' => 'فبراير',
        'March' => 'مارس',
        'April' => 'أبريل',
        'May' => 'مايو',
        'June' => 'يونيو',
        'July' => 'يوليو',
        'August' => 'أغسطس',
        'September' => 'سبتمبر',
        'October' => 'أكتوبر',
        'November' => 'نوفمبر',
        'December' => 'ديسمبر'
    ];

    private function translateDateToArabic($date)
    {
        $carbonDate = Carbon::parse($date);
        $dayName = $this->arabicDays[$carbonDate->format('l')];
        $day = $carbonDate->format('d');
        $monthName = $this->arabicMonths[$carbonDate->format('F')];
        $year = $carbonDate->format('Y');

        return "{$dayName}، {$day} {$monthName} {$year}";
    }

    private function generateArabicWhatsAppMessage($checkIn, $checkOut, $guests)
    {
        $arabicCheckIn = $this->translateDateToArabic($checkIn);
        $arabicCheckOut = $this->translateDateToArabic($checkOut);

        return "مرحباً! أود حجز كوخ في عصارة.

موعد الوصول: {$arabicCheckIn}
موعد المغادرة: {$arabicCheckOut}
المدة: ليلة واحدة
عدد الضيوف: {$guests}

الرجاء إخباري عن التوفر والأسعار لهذه التواريخ. شكراً لكم!";
    }

    public function index()
    {
        // Get cottages from database
        $cottages = Cottage::where('active', true)
                          ->orderBy('featured', 'desc')
                          ->orderBy('created_at', 'desc')
                          ->get();

        // If no cottages in database, use default data
        if ($cottages->isEmpty()) {
            $defaultMessage = $this->generateArabicWhatsAppMessage('2025-07-22', '2025-07-23', 4);
            
            $cottages = collect([
                [
                    'id' => 1,
                    'name' => 'كابين',
                    'cover_image' => 'r1.jpg',
                    'price' => 250,
                    'featured' => true,
                    'whatsapp_message' => $defaultMessage
                ],
                [
                    'id' => 2,
                    'name' => 'اوديسا',
                    'cover_image' => 'r2.jpg',
                    'price' => 200,
                    'featured' => false,
                    'whatsapp_message' => $defaultMessage
                ],
                [
                    'id' => 3,
                    'name' => 'عصارة',
                    'cover_image' => 'r3.jpg',
                    'price' => 180,
                    'featured' => false,
                    'whatsapp_message' => $defaultMessage
                ]
            ]);
        }

        return view('welcome', compact('cottages'));
    }

    public function show($id)
    {
        $cottage = Cottage::find($id);

        if (!$cottage) {
            // Fallback to default data if cottage not found
            $defaultMessage = $this->generateArabicWhatsAppMessage('2025-07-22', '2025-07-23', 4);
            
            $defaultCottages = [
                1 => [
                    'id' => 1,
                    'name' => 'كابين',
                    'cover_image' => 'r1.jpg',
                    'price' => 250,
                    'description' => 'شاليه كابين الفاخر يوفر تجربة إقامة استثنائية مع إطلالة مباشرة على البحر. يتميز بتصميم عصري وديكور راقي يجمع بين الفخامة والراحة.',
                    'features' => [
                        'مسبح خاص',
                        'إطلالة على البحر',
                        'مطبخ مجهز بالكامل',
                        'واي فاي مجاني',
                        'تكييف',
                        'خدمة تنظيف يومية',
                        'موقف سيارات خاص',
                        'نظام أمان 24/7'
                    ],
                    'whatsapp_message' => $defaultMessage
                ],
                2 => [
                    'id' => 2,
                    'name' => 'اوديسا',
                    'cover_image' => 'r2.jpg',
                    'price' => 200,
                    'description' => 'شاليه اوديسا يقدم تجربة إقامة مميزة مع تصميم عصري وإطلالة ساحرة على البحر. يوفر جميع وسائل الراحة العصرية مع لمسة من الأناقة.',
                    'features' => [
                        'وصول مباشر للشاطئ',
                        'شرفة خاصة',
                        'مطبخ صغير',
                        'واي فاي مجاني',
                        'تكييف',
                        'خدمة تنظيف',
                        'دراجات مجانية',
                        'معدات شاطئية'
                    ],
                    'whatsapp_message' => $defaultMessage
                ],
                3 => [
                    'id' => 3,
                    'name' => 'عصارة',
                    'cover_image' => 'r3.jpg',
                    'price' => 180,
                    'description' => 'شاليه عصارة يقدم تجربة إقامة مريحة وهادئة مع إطلالة جميلة على البحر. مثالي للعائلات والأزواج الباحثين عن الراحة والاستجمام.',
                    'features' => [
                        'شاطئ خاص',
                        'حديقة خارجية',
                        'مطبخ بسيط',
                        'واي فاي مجاني',
                        'تكييف',
                        'خدمة تنظيف أسبوعية',
                        'موقف سيارات',
                        'منطقة شواء'
                    ],
                    'whatsapp_message' => $defaultMessage
                ]
            ];

            if (isset($defaultCottages[$id])) {
                $cottage = $defaultCottages[$id];
            } else {
                abort(404);
            }
        } else {
            // Convert database cottage to array format for view
            $cottage = $cottage->toArray();
            $cottage['whatsapp_message'] = $this->generateArabicWhatsAppMessage('2025-07-22', '2025-07-23', 4);
            
            // Load reviews for this cottage
            $reviews = Review::where('cottage_id', $id)
                           ->where('is_approved', true)
                           ->orderBy('created_at', 'desc')
                           ->get();
        }

        return view('cottage-detail', compact('cottage', 'reviews'));
    }

    // Add this method to handle dynamic date updates
    public function updateBookingDates(Request $request)
    {
        $checkIn = $request->input('check_in');
        $checkOut = $request->input('check_out');
        $guests = $request->input('guests', 2);

        $message = $this->generateArabicWhatsAppMessage($checkIn, $checkOut, $guests);
        
        return response()->json([
            'message' => $message
        ]);
    }
} 