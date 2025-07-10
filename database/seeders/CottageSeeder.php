<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cottage;

class CottageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing cottages first
        Cottage::query()->delete();

        $cottages = [
            [
                'name' => 'كابين',
                'price' => 350.00,
                'description' => 'شاليه كابين الفاخر يوفر تجربة إقامة استثنائية مع إطلالة مباشرة على البحر. يتميز بتصميم عصري وديكور راقي يجمع بين الفخامة والراحة. يحتوي على غرف نوم واسعة وحمامات فاخرة ومطبخ مجهز بالكامل. مثالي للعائلات الكبيرة والضيوف الذين يبحثون عن تجربة إقامة مميزة.',
                'cover_image' => 'r1.jpg',
                'features' => [
                    'luxury_bedroom',
                    'central_ac',
                    'high_speed_wifi',
                    'smart_tv',
                    'luxury_bathroom',
                    'sea_view_balcony',
                    'private_pool',
                    'equipped_kitchen',
                    'parking',
                    'security_system',
                    'daily_cleaning',
                    'concierge_service',
                    'gym',
                    'spa_massage'
                ],
                'featured' => true,
                'active' => true,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'max_guests' => 8,
                'location' => 'عصارة',
                'address' => 'شاطئ عصارة، طرابلس، ليبيا',
                'rating' => 4.8,
                'total_reviews' => 25
            ],
            [
                'name' => 'اوديسا',
                'price' => 280.00,
                'description' => 'شاليه اوديسا يقدم تجربة إقامة مميزة مع تصميم عصري وإطلالة ساحرة على البحر. يوفر جميع وسائل الراحة العصرية مع لمسة من الأناقة. يتميز بغرفة نوم رئيسية واسعة وحمام فاخر وشرفة خاصة مطلة على البحر. مثالي للأزواج والعائلات الصغيرة.',
                'cover_image' => 'r2.jpg',
                'features' => [
                    'luxury_bedroom',
                    'central_ac',
                    'high_speed_wifi',
                    'smart_tv',
                    'luxury_bathroom',
                    'sea_view_balcony',
                    'equipped_kitchen',
                    'parking',
                    'security_system',
                    'daily_cleaning',
                    'child_friendly',
                    'non_smoking'
                ],
                'featured' => true,
                'active' => true,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'max_guests' => 5,
                'location' => 'عصارة',
                'address' => 'شاطئ عصارة، طرابلس، ليبيا',
                'rating' => 4.7,
                'total_reviews' => 18
            ],
            [
                'name' => 'عصارة',
                'price' => 220.00,
                'description' => 'شاليه عصارة يقدم تجربة إقامة مريحة وهادئة مع إطلالة جميلة على البحر. مثالي للعائلات والأزواج الباحثين عن الراحة والاستجمام. يتميز بتصميم بسيط وأنيق مع جميع وسائل الراحة الأساسية. يوفر إطلالة مباشرة على البحر ووصول سهل للشاطئ.',
                'cover_image' => 'r3.jpg',
                'features' => [
                    'luxury_bedroom',
                    'central_ac',
                    'high_speed_wifi',
                    'smart_tv',
                    'luxury_bathroom',
                    'equipped_kitchen',
                    'parking',
                    'security_system',
                    'child_friendly',
                    'non_smoking',
                    'pet_friendly'
                ],
                'featured' => false,
                'active' => true,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'max_guests' => 4,
                'location' => 'عصارة',
                'address' => 'شاطئ عصارة، طرابلس، ليبيا',
                'rating' => 4.5,
                'total_reviews' => 12
            ],
            [
                'name' => 'فلوريت',
                'price' => 190.00,
                'description' => 'شاليه فلوريت يوفر إقامة مريحة وبسيطة مع إطلالة جميلة على البحر. مثالي للمسافرين الفرديين والأزواج الذين يبحثون عن مكان هادئ للاسترخاء. يتميز بتصميم مريح وبيئة نظيفة مع جميع الخدمات الأساسية.',
                'cover_image' => 'r1.jpg',
                'features' => [
                    'luxury_bedroom',
                    'central_ac',
                    'high_speed_wifi',
                    'smart_tv',
                    'luxury_bathroom',
                    'equipped_kitchen',
                    'parking',
                    'security_system',
                    'non_smoking',
                    'accessible'
                ],
                'featured' => false,
                'active' => true,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'max_guests' => 3,
                'location' => 'عصارة',
                'address' => 'شاطئ عصارة، طرابلس، ليبيا',
                'rating' => 4.3,
                'total_reviews' => 9
            ],
            [
                'name' => 'ذهبية',
                'price' => 160.00,
                'description' => 'شاليه ذهبية يقدم إقامة اقتصادية ومريحة مع إطلالة على البحر. مثالي للمسافرين ذوي الميزانية المحدودة الذين يبحثون عن مكان نظيف ومريح. يوفر جميع الخدمات الأساسية مع بيئة هادئة ومناسبة للاسترخاء.',
                'cover_image' => 'r2.jpg',
                'features' => [
                    'luxury_bedroom',
                    'central_ac',
                    'high_speed_wifi',
                    'smart_tv',
                    'luxury_bathroom',
                    'equipped_kitchen',
                    'parking',
                    'security_system',
                    'non_smoking',
                    'child_friendly'
                ],
                'featured' => false,
                'active' => true,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'max_guests' => 2,
                'location' => 'عصارة',
                'address' => 'شاطئ عصارة، طرابلس، ليبيا',
                'rating' => 4.2,
                'total_reviews' => 7
            ]
        ];

        foreach ($cottages as $cottageData) {
            Cottage::create($cottageData);
        }
    }
} 