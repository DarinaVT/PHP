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
            [
                'name' => 'Adventure Tours',
                'email' => 'contact@adventure.com',
                'phone' => '+30 210 123 4567',
                'address' => '45 Beach Road, Athens, Greece',
            ],
            [
                'name' => 'Luxury Vacations Ltd',
                'email' => 'info@luxuryvacations.com',
                'phone' => '+34 912 345 678',
                'address' => '78 Sunset Boulevard, Barcelona, Spain',
            ],
            [
                'name' => 'Budget Travel Solutions',
                'email' => 'hello@budgettravel.com',
                'phone' => '+1 555 123 4567',
                'address' => '90 Market Street, New York, USA',
            ],
            [
                'name' => 'Family Holidays Co',
                'email' => 'info@familyholidays.com',
                'phone' => '+44 20 1234 5678',
                'address' => '12 Park Lane, London, UK',
            ],
            [
                'name' => 'Exotic Destinations',
                'email' => 'book@exoticdestinations.com',
                'phone' => '+66 2 123 4567',
                'address' => '56 Beach Road, Bangkok, Thailand',
            ],
        ];

        foreach ($organizers as $organizer) {
            Organizer::create($organizer);
        }
    }
}