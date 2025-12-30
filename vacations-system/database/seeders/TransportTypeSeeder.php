<?php

namespace Database\Seeders;

use App\Models\TransportType;
use Illuminate\Database\Seeder;

class TransportTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Airplane',
                'description' => 'Travel by commercial or private aircraft. Fast and comfortable for long distances.',
            ],
            [
                'name' => 'Bus',
                'description' => 'Travel by bus or coach. Economical option for group travel.',
            ],
            [
                'name' => 'Train',
                'description' => 'Travel by railway. Scenic and comfortable journey.',
            ],
            [
                'name' => 'Car',
                'description' => 'Travel by personal or rental car. Freedom to explore at your own pace.',
            ],
            [
                'name' => 'Ship',
                'description' => 'Travel by cruise ship or ferry. Relaxing journey on water.',
            ],
            [
                'name' => 'Motorcycle',
                'description' => 'Travel by motorcycle. Adventure and freedom for thrill seekers.',
            ],
        ];

        foreach ($types as $type) {
            TransportType::create($type);
        }
    }
}