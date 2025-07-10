# Admin Dashboard for Asara Beach Cottages

This is a simple admin dashboard for managing cottages on your Asara Beach Cottages website.

## Features

- **Cottage Management**: Add, edit, and delete cottages
- **Image Upload**: Upload cottage images with automatic naming
- **Statistics**: View dashboard statistics (total cottages, featured cottages, bookings)
- **Responsive Design**: Works on desktop and mobile devices
- **Arabic Support**: Full RTL support and Arabic interface

## Files Created

### Frontend Files:
- `resources/views/admin/dashboard.blade.php` - Main dashboard view
- `public/css/admin-dashboard.css` - Dashboard styling
- `public/js/admin-dashboard.js` - Dashboard functionality

### Backend Files:
- `app/Http/Controllers/AdminController.php` - Controller for dashboard and API
- `database/migrations/2024_12_08_000001_create_cottages_table.php` - Database migration
- Updated `routes/web.php` - Added admin routes

## Setup Instructions

1. **Access the Dashboard:**
   - Navigate to: `http://your-domain.com/admin/dashboard`

2. **Run Migration (Optional):**
   ```bash
   php artisan migrate
   ```

3. **Set Permissions:**
   - Make sure the `public/images` directory is writable
   - Set proper permissions for image uploads

## Usage

### Adding a New Cottage

1. Click "إضافة شاليه جديد" (Add New Cottage)
2. Fill in the cottage details:
   - Name (اسم الشاليه)
   - Price (السعر)
   - Description (وصف الشاليه)
   - Upload image (optional)
   - Mark as featured (optional)
3. Click "حفظ" (Save)

### Editing a Cottage

1. Click the yellow edit icon (✏️) next to any cottage
2. Modify the details in the modal
3. Click "حفظ" (Save)

### Deleting a Cottage

1. Click the red delete icon (🗑️) next to any cottage
2. Confirm deletion in the popup
3. The cottage and its image will be deleted

### Image Management

- Images are automatically renamed to `r{cottage_id}.jpg`
- Old images are replaced when uploading new ones
- Images are stored in `public/images/` directory

## API Endpoints

The dashboard uses these API endpoints:

- `GET /api/cottages` - Get all cottages
- `GET /api/cottages/{id}` - Get specific cottage
- `POST /api/cottages` - Create new cottage
- `PUT /api/cottages/{id}` - Update cottage
- `DELETE /api/cottages/{id}` - Delete cottage
- `POST /api/upload-image` - Upload cottage image
- `GET /api/stats` - Get dashboard statistics

## Database Integration

Currently, the system uses mock data. To integrate with a real database:

1. **Run the migration:**
   ```bash
   php artisan migrate
   ```

2. **Update the AdminController:**
   - Replace the `getCottagesData()` method with actual database queries
   - Use Eloquent model for cottage operations

3. **Create a Cottage Model:**
   ```bash
   php artisan make:model Cottage
   ```

## Customization

### Adding New Fields

1. **Update the migration** to add new columns
2. **Update the form** in `dashboard.blade.php`
3. **Update the controller** to handle new fields
4. **Update the JavaScript** to handle new form fields

### Changing Styles

- Edit `public/css/admin-dashboard.css`
- The CSS matches your website's color scheme (#2C5F7F to #64B5F6)

### Adding Features

- Bulk operations
- Image gallery for each cottage
- Booking management
- Advanced statistics

## Security Notes

- Add authentication middleware to protect admin routes
- Validate file uploads properly
- Use CSRF protection (already included)
- Consider adding role-based permissions

## Troubleshooting

### Images Not Uploading
- Check `public/images` directory permissions
- Verify file size limits in `php.ini`
- Check Laravel's file upload configuration

### JavaScript Errors
- Ensure all CSS and JS files are properly linked
- Check browser console for specific errors
- Verify CSRF token is set correctly

### Database Errors
- Run migrations: `php artisan migrate`
- Check database connection in `.env`
- Verify table structure matches controller expectations

## Next Steps

To make this production-ready:

1. Add proper authentication
2. Implement database operations
3. Add input validation
4. Add proper error handling
5. Add logging for admin actions
6. Consider adding image optimization
7. Add backup/restore functionality

## Support

For any issues or questions, refer to the Laravel documentation or check the browser console for JavaScript errors. 