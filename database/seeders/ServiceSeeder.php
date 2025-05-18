<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['service_name' => 'Breakfast',        'service_price' => 50000],
            ['service_name' => 'Laundry',          'service_price' => 30000],
            ['service_name' => 'Airport Pickup',   'service_price' => 100000],
            ['service_name' => 'Spa',              'service_price' => 150000],
            ['service_name' => 'Extra Bed',        'service_price' => 75000],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
