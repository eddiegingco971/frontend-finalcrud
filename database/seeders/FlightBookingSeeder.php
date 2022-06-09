<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FlightBooking;


class FlightBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlightBooking::factory(5)->create();
    }
}
