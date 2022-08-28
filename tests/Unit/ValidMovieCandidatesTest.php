<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Location;
use App\Helpers\Testing\MovieCandidatesAttributes;
use App\Models\Pornstar;

class ValidMovieCandidatesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateMinimumMovieCandidateWithDifferentCameraStyles()
    {

        $payload = [
        'abundance' => MovieCandidatesAttributes::getRandomAbundance(),
        'duration' => date('H:i:s', rand(1, 200000)),
        'title' => 'nice title'
        ];

        $cameraStyles = MovieCandidatesAttributes::CAMERA_STYLES;

        $user = User::factory()
            ->employeeAllowedToMakeMovieCandidates()
            ->create();

        foreach($cameraStyles as $cameraStyle) {
            $payload['camera_style'] = $cameraStyle;
            $response = $this->actingAs($user)
                ->postJson('/movie-candidate', $payload);
    
            $response->assertStatus(201)
                ->assertJson($payload);
        }

    }

    public function testCreateMinimumMovieCandidateWithDifferentLocations()
    {
        $payload = MovieCandidatesAttributes::getMinimumRequiredPayload();
    
            $locations = Location::pluck('name')->toArray();
    
            $user = User::factory()
                ->employeeAllowedToMakeMovieCandidates()
                ->create();
    
            foreach($locations as $locationID => $location) {
                $payload['location'] = $location;
                $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
                $payloadToAssert = MovieCandidatesAttributes::parseToMatchResponse($payload);
                $response->assertStatus(201)
                    ->assertJson($payloadToAssert);
            }
    }

    public function testCreateMinimumMovieCandidateWithDifferentAbundances()
    {
        $payload = [
            'duration' => date('H:i:s', rand(1, 200000)),
            'title' => 'nice title',
            'camera_style' => 'outside',
            ];
    
            $abundances = MovieCandidatesAttributes::ABUNDANCES;
    
            $user = User::factory()
                ->employeeAllowedToMakeMovieCandidates()
                ->create();
    
            foreach($abundances as $abundance) {
                $payload['abundance'] = $abundance;
                $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
        
                $response->assertStatus(201)
                    ->assertJson($payload);
            }
    }

    public function testCreateMinimumMovieCandidateWithPornstars()
    {
        $payload = MovieCandidatesAttributes::getMinimumRequiredPayload();

        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();

        $pornstarsNickames = Pornstar::inRandomOrder()
                                    ->limit(rand(1,7))
                                    ->pluck('nickname')
                                    ->toArray();

        $payload['pornstars_list'] = $pornstarsNickames;
        $expectedPayload = MovieCandidatesAttributes::parseToMatchResponse($payload);

        $response = $this->actingAs($user)
                        ->postJson(route('movie-candidate.create'), $payload);
        
        $response->assertStatus(201)
                 ->assertJson($expectedPayload);
    }

    public function testCreateMovieCandidateWithAllFields()
    {
        $payload = MovieCandidatesAttributes::getRandomCompletePayload();
        $payloadResponse = MovieCandidatesAttributes::parseToMatchResponse($payload);
        
        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();
        
        $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
    
        $response->assertStatus(201)
                    ->assertJson($payloadResponse);
    }

}
