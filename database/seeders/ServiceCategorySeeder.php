<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;

class ServiceCategorySeeder extends Seeder
{
    public function run()
    {
        // Body-Based Services
        $bodyBased = ServiceCategory::create([
            'name' => 'Body-Based Services',
            'slug' => 'body-based-services',
            'description' => 'Physical and body-focused healing practices',
            'is_active' => true,
        ]);

        ServiceSubcategory::create([
            'category_id' => $bodyBased->id,  // Changed from service_category_id
            'name' => 'Massage Therapy',
            'slug' => 'massage-therapy',
            'description' => 'Therapeutic massage services',
            'is_active' => true,
            'display_order' => 1,
        ]);

        ServiceSubcategory::create([
            'category_id' => $bodyBased->id,  // Changed from service_category_id
            'name' => 'Deep Tissue Massage',
            'slug' => 'deep-tissue-massage',
            'description' => 'Deep tissue therapeutic massage',
            'is_active' => true,
            'display_order' => 2,
        ]);

        ServiceSubcategory::create([
            'category_id' => $bodyBased->id,  // Changed from service_category_id
            'name' => 'Sports Massage',
            'slug' => 'sports-massage',
            'description' => 'Massage for athletes and active individuals',
            'is_active' => true,
            'display_order' => 3,
        ]);

        // Energy Healing
        $energyHealing = ServiceCategory::create([
            'name' => 'Energy Healing',
            'slug' => 'energy-healing',
            'description' => 'Energy-based healing practices',
            'is_active' => true,
        ]);

        ServiceSubcategory::create([
            'category_id' => $energyHealing->id,  // Changed from service_category_id
            'name' => 'Reiki',
            'slug' => 'reiki',
            'description' => 'Japanese energy healing technique',
            'is_active' => true,
            'display_order' => 1,
        ]);

        ServiceSubcategory::create([
            'category_id' => $energyHealing->id,  // Changed from service_category_id
            'name' => 'Crystal Healing',
            'slug' => 'crystal-healing',
            'description' => 'Healing with crystals and stones',
            'is_active' => true,
            'display_order' => 2,
        ]);

        // Mind-Body Practices
        $mindBody = ServiceCategory::create([
            'name' => 'Mind-Body Practices',
            'slug' => 'mind-body-practices',
            'description' => 'Holistic mind-body wellness practices',
            'is_active' => true,
        ]);

        ServiceSubcategory::create([
            'category_id' => $mindBody->id,  // Changed from service_category_id
            'name' => 'Yoga',
            'slug' => 'yoga',
            'description' => 'Traditional and modern yoga practices',
            'is_active' => true,
            'display_order' => 1,
        ]);

        ServiceSubcategory::create([
            'category_id' => $mindBody->id,  // Changed from service_category_id
            'name' => 'Meditation',
            'slug' => 'meditation',
            'description' => 'Guided meditation and mindfulness',
            'is_active' => true,
            'display_order' => 2,
        ]);
    }
}