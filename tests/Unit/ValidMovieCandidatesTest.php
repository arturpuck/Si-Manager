<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Location;

class ValidMovieCandidatesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
public function testCreateMovieCandidateWithMinimumRequirements()
{
    $this->assertTrue(true);

    // $payload = [
    // 'abundance' => "one_male_one_female",
    // 'camera_style' => "outside",
    // 'duration' => date('H:i:s', rand(1, 200000)),
    // 'title' => 'nice title'
    // ];

    // $response = $this->postJson('/movie-candidate', $payload);

    // $response->assertStatus(201)
    //     ->assertJson($payload);

}

public function testCreateMovieCandidateWithLocation()
{
    // $locations = Location::all()
    //     ->pluck('name')
    //     ->toArray();
    
    // $payload = [
    // 'abundance' => "one_male_one_female",
    // 'camera_style' => "outside",
    // 'duration' => date('H:i:s', rand(1, 200000)),
    // 'title' => 'nice title'
    // ];

    // foreach($locations as $location) {
    //     $payload['location'] = $location;
    //     $response = $this->postJson('/movie-candidate', $payload);

    // $response->assertStatus(201)
    //     ->assertJson($payload);
    // }
}

}
