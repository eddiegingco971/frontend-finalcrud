<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
class FlightBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'airlines'=> $this->faker->randomElement(['Philippine Airlines', 'Cebu Pacific', 'AirAsia Philippines','Cebgo', 'Jeju Air', 'SkyJet Airlines']),
            'category'=> $this->faker->randomElement(['First Class Seat', 'Second Class Seat', 'Third Class Seat']),
            'travel_place'=> $this->faker->randomElement(['Philippines To Japan','Philippines To Switzerland','Philippines To Spain','Philippines To America', 'Philippines To Italy', 'Philippines To Spain']),
            'price'=> $this->faker->randomFloat(2, 1, 9999),
            'arrival'=> $this->faker->dateTime(),
            'departure'=> $this->faker->dateTime(),
        ];
    }
}

