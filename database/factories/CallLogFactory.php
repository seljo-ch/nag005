<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CallLog>
 */
class CallLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'CallerNumber' => fake('de_CH')->e164PhoneNumber(),
            'CallerDisplayName' => fake('de_CH')->name(),
            'ADUser' => 'nyffenegger\\ose',
            'Email' => fake('de_CH')->email(),
            'Timestamp' => fake()->dateTime()
        ];
    }
}
