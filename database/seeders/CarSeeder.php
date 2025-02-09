<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run()
    {
        // Ensure we have an admin user
        $admin = User::where('email', 'admin@example.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_admin' => true
            ]);
        }

        // Executive Cars Collection with high-quality images
        $executiveCars = [
            [
                'title' => 'Mercedes-Benz S-Class 2024',
                'description' => 'The epitome of luxury and technological innovation. Features include Executive Rear Seat Package, MBUX Interior Assistant, and ENERGIZING Comfort Control.',
                'price' => 149000,
                'year' => 2024,
                'make' => 'Mercedes-Benz',
                'model' => 'S-Class',
                'mileage' => 0,
                'body_type' => 'Sedan',
                'color' => 'Obsidian Black',
                'transmission' => 'Automatic',
                'fuel_type' => 'Hybrid',
                'condition' => 'New',
                'features' => json_encode([
                    'Executive Rear Package',
                    'MBUX Interior Assistant',
                    'ENERGIZING Comfort Control',
                    'Burmester® 4D Surround Sound',
                    'Active Ambient Lighting'
                ]),
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1616788494672-ec7ca25fdda9?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1616788494707-ec63fd027e8a?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1616788494801-ef870be46103?w=1000&h=500&fit=crop'
                ])
            ],
            [
                'title' => 'BMW 7 Series 2024',
                'description' => 'A masterpiece of automotive excellence featuring BMW Theatre Screen, Executive Lounge seating, and Sky Lounge LED roof.',
                'price' => 165000,
                'year' => 2024,
                'make' => 'BMW',
                'model' => '7 Series',
                'mileage' => 0,
                'body_type' => 'Sedan',
                'color' => 'Alpine White',
                'transmission' => 'Automatic',
                'fuel_type' => 'Electric',
                'condition' => 'New',
                'features' => json_encode([
                    'BMW Theatre Screen',
                    'Executive Lounge Seating',
                    'Sky Lounge LED Roof',
                    'Bowers & Wilkins Diamond Surround Sound',
                    'BMW Digital Key Plus'
                ]),
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1607853202273-797f1c22a38e?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1607853202275-d3c623410d45?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1607853202277-71c8f8e9e43a?w=1000&h=500&fit=crop'
                ])
            ],
            [
                'title' => 'Rolls-Royce Ghost 2024',
                'description' => 'The purest expression of Rolls-Royce featuring Starlight Headliner, Illuminated Fascia, and planar suspension system.',
                'price' => 375000,
                'year' => 2024,
                'make' => 'Rolls-Royce',
                'model' => 'Ghost',
                'mileage' => 0,
                'body_type' => 'Sedan',
                'color' => 'Arctic White',
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'condition' => 'New',
                'features' => json_encode([
                    'Starlight Headliner',
                    'Illuminated Fascia',
                    'Planar Suspension System',
                    'Bespoke Audio',
                    'Micro-Environment Purification System'
                ]),
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1631295868223-63265b40d9e4?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1631295868225-702453d89872?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1631295868227-2f10ff0fdd0c?w=1000&h=500&fit=crop'
                ])
            ],
            [
                'title' => 'Bentley Flying Spur 2024',
                'description' => 'The ultimate in luxury performance with Mulliner Driving Specification, rotating display, and diamond quilting.',
                'price' => 285000,
                'year' => 2024,
                'make' => 'Bentley',
                'model' => 'Flying Spur',
                'mileage' => 0,
                'body_type' => 'Sedan',
                'color' => 'Meteor Grey',
                'transmission' => 'Automatic',
                'fuel_type' => 'Hybrid',
                'condition' => 'New',
                'features' => json_encode([
                    'Mulliner Driving Specification',
                    'Rotating Display',
                    'Diamond Quilting',
                    'Naim for Bentley Audio',
                    'City Specification Package'
                ]),
                'images' => json_encode([
                    'https://images.unsplash.com/photo-1621248861756-768f4035a2f3?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1621248861758-7c3d0d31b58f?w=1000&h=500&fit=crop',
                    'https://images.unsplash.com/photo-1621248861760-87e4b4b4b4b0?w=1000&h=500&fit=crop'
                ])
            ]
        ];

        foreach ($executiveCars as $car) {
            $car['user_id'] = $admin->id;
            $car['status'] = 'available';
            $car['is_featured'] = true;
            Car::create($car);
        }
    }
}
