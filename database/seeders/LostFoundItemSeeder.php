<?php

namespace Database\Seeders;

use App\Models\LostFoundItem;
use Illuminate\Database\Seeder;

class LostFoundItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'type' => 'lost',
                'title' => 'Black Leather Wallet',
                'description' => 'Lost my black leather wallet near the community park. It contains my ID, some cash, and a few credit cards.',
                'category' => 'accessories',
                'location' => 'Community Park, Main Street',
                'date' => '2026-01-10',
                'contact_name' => 'John Smith',
                'contact_email' => 'john.smith@email.com',
                'contact_phone' => '(555) 123-4567',
                'status' => 'active',
                'reward' => '$50',
            ],
            [
                'type' => 'found',
                'title' => 'Silver iPhone 15',
                'description' => 'Found a silver iPhone 15 on the bench near the library. It has a blue case.',
                'category' => 'electronics',
                'location' => 'City Library, 2nd Floor',
                'date' => '2026-01-12',
                'contact_name' => 'Sarah Johnson',
                'contact_email' => 'sarah.j@email.com',
                'contact_phone' => '(555) 987-6543',
                'status' => 'active',
            ],
            [
                'type' => 'lost',
                'title' => 'Golden Retriever - Buddy',
                'description' => 'My golden retriever Buddy ran away from the dog park. He is friendly and wearing a red collar.',
                'category' => 'pets',
                'location' => 'Riverside Dog Park',
                'date' => '2026-01-14',
                'contact_name' => 'Mike Davis',
                'contact_email' => 'mike.davis@email.com',
                'contact_phone' => '(555) 456-7890',
                'status' => 'active',
                'reward' => '$200',
            ],
        ];

        foreach ($items as $item) {
            LostFoundItem::create($item);
        }
    }
}