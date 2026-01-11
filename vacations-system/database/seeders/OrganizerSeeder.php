<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    public function run(): void
    {
        $organizers = [
            [
                'name' => 'Sun Travel Agency',
                'email' => 'info@suntravel.com',
                'phone' => '+359 2 123 4567',
                'address' => '123 Main Street, Sofia, Bulgaria',
            ],
        ];

        foreach ($organizers as $organizer) {
            Organizer::firstOrCreate(
                ['email' => $organizer['email']],
                $organizer
            );
        }
    }
}