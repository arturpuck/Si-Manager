<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\Testing\MovieCandidatesAttributes;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MovieCandidate>
 */
class MovieCandidateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'abundance' => MovieCandidatesAttributes::getRandomAbundance(),
            'duration' => date('H:i:s', rand(1, 200000)),
            'title' => $this->faker->text(120),
            'camera_style' => MovieCandidatesAttributes::getRandomCameraStyle()
        ];
    }
}
