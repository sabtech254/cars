<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\User;

class CarSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        
        $cars = [
            [
                'title' => '2023 Mercedes-Benz S-Class',
                'make' => 'Mercedes-Benz',
                'model' => 'S-Class',
                'year' => 2023,
                'price' => 110000,
                'description' => 'Luxury sedan with advanced features and premium comfort.',
                'condition' => 'new',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'mileage' => 0,
                'body_type' => 'sedan',
                'color' => 'Black',
                'is_featured' => true,
                'status' => 'available',
                'features' => json_encode([
                    'Leather seats',
                    'Panoramic sunroof',
                    'Advanced driver assistance',
                    'Premium sound system'
                ]),
                'images' => json_encode([
                    '/images/cars/mercedes-s-class-1.jpg',
                    '/images/cars/mercedes-s-class-2.jpg'
                ])
            ],
            [
                'title' => '2022 BMW X7',
                'make' => 'BMW',
                'model' => 'X7',
                'year' => 2022,
                'price' => 95000,
                'description' => 'Luxury SUV with spacious interior and powerful performance.',
                'condition' => 'used',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'mileage' => 15000,
                'body_type' => 'suv',
                'color' => 'White',
                'is_featured' => true,
                'status' => 'available',
                'features' => json_encode([
                    'Third-row seating',
                    'All-wheel drive',
                    'Premium audio system',
                    'Advanced safety features'
                ]),
                'images' => json_encode([
                    '/images/cars/bmw-x7-1.jpg',
                    '/images/cars/bmw-x7-2.jpg'
                ])
            ],
            [
                'title' => '2023 Porsche 911',
                'make' => 'Porsche',
                'model' => '911',
                'year' => 2023,
                'price' => 135000,
                'description' => 'High-performance sports car with iconic design.',
                'condition' => 'new',
                'transmission' => 'automatic',
                'fuel_type' => 'petrol',
                'mileage' => 500,
                'body_type' => 'coupe',
                'color' => 'Red',
                'is_featured' => true,
                'status' => 'available',
                'features' => json_encode([
                    'Sport Chrono Package',
                    'Carbon fiber interior',
                    'Sport exhaust system',
                    'Adaptive sport seats'
                ]),
                'images' => json_encode([
                    '/images/cars/porsche-911-1.jpg',
                    '/images/cars/porsche-911-2.jpg'
                ])
            ],
            [
                'title' => '2022 Tesla Model S',
                'make' => 'Tesla',
                'model' => 'Model S',
                'year' => 2022,
                'price' => 89000,
                'description' => 'All-electric luxury sedan with cutting-edge technology.',
                'condition' => 'used',
                'transmission' => 'automatic',
                'fuel_type' => 'electric',
                'mileage' => 8000,
                'body_type' => 'sedan',
                'color' => 'Silver',
                'is_featured' => true,
                'status' => 'available',
                'features' => json_encode([
                    'Autopilot',
                    'Full Self-Driving capability',
                    'Premium audio',
                    'Glass roof'
                ]),
                'images' => json_encode([
                    '/images/cars/tesla-models-1.jpg',
                    '/images/cars/tesla-models-2.jpg'
                ])
            ],
        ];

        foreach ($cars as $carData) {
            $carData['user_id'] = $users->random()->id;
            Car::create($carData);
        }
    }
}
