<?php

namespace Database\Seeders;

use App\Models\Vacation;
use App\Models\TransportType;
use App\Models\Organizer;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VacationSeeder extends Seeder
{
    public function run(): void
    {
        $airplane = TransportType::where('name', 'Airplane')->first();
        $bus = TransportType::where('name', 'Bus')->first();
        $train = TransportType::where('name', 'Train')->first();
        $car = TransportType::where('name', 'Car')->first();
        $ship = TransportType::where('name', 'Ship')->first();
        
        $organizer1 = Organizer::where('name', 'Sun Travel Agency')->first();
        $organizer2 = Organizer::where('name', 'Adventure Tours')->first();
        $organizer3 = Organizer::where('name', 'Luxury Vacations Ltd')->first();
        $organizer4 = Organizer::where('name', 'Budget Travel Solutions')->first();
        $organizer5 = Organizer::where('name', 'Family Holidays Co')->first();

        $vacations = [
            [
                'name' => 'Summer in Varna',
                'start_date' => Carbon::now()->addDays(30),
                'end_date' => Carbon::now()->addDays(37),
                'duration' => 8,
                'transport_type_id' => $bus->id,
                'organizer_id' => $organizer1->id,
                'price' => 450.00,
                'description' => 'Beautiful summer vacation on the Black Sea coast. Enjoy sandy beaches, warm weather, and vibrant nightlife.',
                'city' => 'Varna',
                'country' => 'Bulgaria',
                'max_guests' => 4,
            ],
            [
                'name' => 'Greek Islands Adventure',
                'start_date' => Carbon::now()->addDays(45),
                'end_date' => Carbon::now()->addDays(52),
                'duration' => 8,
                'transport_type_id' => $airplane->id,
                'organizer_id' => $organizer2->id,
                'price' => 1200.00,
                'description' => 'Explore the beautiful Greek islands. Visit Santorini, Mykonos, and Crete. Experience authentic Greek culture and cuisine.',
                'city' => 'Santorini',
                'country' => 'Greece',
                'max_guests' => 2,
            ],
            [
                'name' => 'Barcelona City Break',
                'start_date' => Carbon::now()->addDays(60),
                'end_date' => Carbon::now()->addDays(63),
                'duration' => 4,
                'transport_type_id' => $airplane->id,
                'organizer_id' => $organizer3->id,
                'price' => 800.00,
                'description' => 'Experience the vibrant culture of Barcelona. Visit Gaudi\'s masterpieces, enjoy tapas, and relax on the beach.',
                'city' => 'Barcelona',
                'country' => 'Spain',
                'max_guests' => 2,
            ],
            [
                'name' => 'Alpine Mountain Retreat',
                'start_date' => Carbon::now()->addDays(75),
                'end_date' => Carbon::now()->addDays(82),
                'duration' => 8,
                'transport_type_id' => $train->id,
                'organizer_id' => $organizer4->id,
                'price' => 950.00,
                'description' => 'Mountain getaway in the Swiss Alps. Hiking, skiing, and breathtaking views. Perfect for nature lovers.',
                'city' => 'Zermatt',
                'country' => 'Switzerland',
                'max_guests' => 4,
            ],
            [
                'name' => 'Mediterranean Cruise',
                'start_date' => Carbon::now()->addDays(90),
                'end_date' => Carbon::now()->addDays(97),
                'duration' => 8,
                'transport_type_id' => $ship->id,
                'organizer_id' => $organizer5->id,
                'price' => 1500.00,
                'description' => 'Luxury cruise through the Mediterranean. Visit multiple ports, enjoy fine dining, and relax on deck.',
                'city' => 'Athens',
                'country' => 'Greece',
                'max_guests' => 2,
            ],
            [
                'name' => 'Road Trip Through Italy',
                'start_date' => Carbon::now()->addDays(105),
                'end_date' => Carbon::now()->addDays(112),
                'duration' => 8,
                'transport_type_id' => $car->id,
                'organizer_id' => $organizer1->id,
                'price' => 1100.00,
                'description' => 'Self-drive adventure through Italy. Visit Rome, Florence, and Venice at your own pace.',
                'city' => 'Rome',
                'country' => 'Italy',
                'max_guests' => 4,
            ],
            [
                'name' => 'Weekend in Paris',
                'start_date' => Carbon::now()->addDays(15),
                'end_date' => Carbon::now()->addDays(17),
                'duration' => 3,
                'transport_type_id' => $airplane->id,
                'organizer_id' => $organizer3->id,
                'price' => 650.00,
                'description' => 'Romantic weekend in the City of Light. Visit the Eiffel Tower, Louvre, and enjoy French cuisine.',
                'city' => 'Paris',
                'country' => 'France',
                'max_guests' => 2,
            ],
            [
                'name' => 'Beach Holiday in Thailand',
                'start_date' => Carbon::now()->addDays(120),
                'end_date' => Carbon::now()->addDays(127),
                'duration' => 8,
                'transport_type_id' => $airplane->id,
                'organizer_id' => $organizer2->id,
                'price' => 1350.00,
                'description' => 'Tropical paradise in Thailand. White sandy beaches, crystal clear water, and exotic cuisine.',
                'city' => 'Phuket',
                'country' => 'Thailand',
                'max_guests' => 4,
            ],
            [
                'name' => 'Scandinavian Tour',
                'start_date' => Carbon::now()->addDays(135),
                'end_date' => Carbon::now()->addDays(142),
                'duration' => 8,
                'transport_type_id' => $train->id,
                'organizer_id' => $organizer4->id,
                'price' => 1400.00,
                'description' => 'Explore the Nordic countries. Visit Stockholm, Copenhagen, and Oslo. Experience the midnight sun.',
                'city' => 'Stockholm',
                'country' => 'Sweden',
                'max_guests' => 2,
            ],
            [
                'name' => 'Budget Weekend Getaway',
                'start_date' => Carbon::now()->addDays(20),
                'end_date' => Carbon::now()->addDays(22),
                'duration' => 3,
                'transport_type_id' => $bus->id,
                'organizer_id' => $organizer4->id,
                'price' => 250.00,
                'description' => 'Affordable weekend trip. Perfect for students and budget travelers. Explore nearby cities and attractions.',
                'city' => 'Sofia',
                'country' => 'Bulgaria',
                'max_guests' => 4,
            ],
        ];

        foreach ($vacations as $vacation) {
            Vacation::create($vacation);
        }
    }
}