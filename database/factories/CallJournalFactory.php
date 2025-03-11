<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CallJournal>
 */
class CallJournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'callerNumber' => fake('de_CH')->e164PhoneNumber(),
            'callerDisplayName' => fake('de_CH')->name(),
            'adUser' => 'nyffenegger\\ose',
            'adUserEmail' => 'test@example.com',
            'note' => fake()->boolean() ? '1' : '0',
            'internalCall' => fake()->boolean() ? '1' : '0',
            'timestamp' => fake()->dateTime()
        ];
    }
}
