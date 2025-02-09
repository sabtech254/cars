<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value');
            $table->timestamps();
        });

        // Insert default settings
        $settings = [
            [
                'key' => 'site_name',
                'value' => 'Car Dealership'
            ],
            [
                'key' => 'site_description',
                'value' => 'Your trusted platform for buying and selling cars'
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@example.com'
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1234567890'
            ],
            [
                'key' => 'address',
                'value' => '123 Car Street, Automotive City, AC 12345'
            ],
            [
                'key' => 'currency_symbol',
                'value' => '$'
            ],
            [
                'key' => 'featured_cars_limit',
                'value' => '6'
            ],
            [
                'key' => 'auction_duration_days',
                'value' => '7'
            ]
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insert([
                'key' => $setting['key'],
                'value' => $setting['value'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
