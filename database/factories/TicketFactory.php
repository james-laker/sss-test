<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

define('CONTENT_LIMIT', 255);
define('SUBJECT_LIMIT', 45);

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => Str::limit($this->faker->sentence(), SUBJECT_LIMIT),
            'content' => Str::limit($this->faker->paragraph(), CONTENT_LIMIT),
            'user_id' => $this->faker->numberBetween(1, 10),
            'status' => false,
        ];
    }
}
