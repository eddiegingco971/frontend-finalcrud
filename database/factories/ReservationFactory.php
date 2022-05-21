<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'roomNumber' => $this->faker -> numerify('##'),
            'roomType' => $this->faker -> randomElement(["First Class", "Second Class", "Third Class"]),
            'fullName'=> $this->faker->name,
            'description' => $this->faker->randomElement(["Single Bed", "Double Bed", "Triple Bed", "Family Size Bed"]),
            'dateReserve' => $this->faker->date,
        ];
    }
}
