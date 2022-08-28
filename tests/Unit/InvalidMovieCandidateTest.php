<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MovieCandidate;
use App\Helpers\Testing\MovieCandidatesAttributes;
use App\Models\User;

class InvalidMovieCandidateTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function createMovieCandidateWithMissingRequiredData(string $key)
    {
        $payload = MovieCandidatesAttributes::getRandomCompletePayload();
        unset($payload[$key]);
        
        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();
        
        $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
    
        $response->assertStatus(400)
                    ->assertJson(["errors" => [trans('validation.required', ['attribute' => str_replace('_',' ', $key)])]]);
    }

    public function testCreateMovieCandidateWithMissingAbundance()
    {
        $this->createMovieCandidateWithMissingRequiredData('duration');
    }

    public function testCreateMovieCandidateWithMissingCameraStyle()
    {
        $this->createMovieCandidateWithMissingRequiredData('camera_style');
    }

    public function testCreateMovieCandidateWithMissingTitle()
    {
        $this->createMovieCandidateWithMissingRequiredData('title');
    }

    public function testCreateMovieCandidateWithMissingDuration()
    {
        $this->createMovieCandidateWithMissingRequiredData('duration');
    }

    public function testCreateMovieCandidateWithInvalidPornstar()
    {
        $payload = MovieCandidatesAttributes::getRandomCompletePayload();
        $payload['pornstars_list'] = ['Balbina królowa Wejherowa'];
        
        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();
        
        $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
    
        $response->assertStatus(400)
                    ->assertJson(["errors" => [trans('validation.exists', ['attribute' => 'pornstars_list.0'])]]);
    }

    public function testCreateMovieCandidateWithInvalidAbundance()
    {
        $payload = MovieCandidatesAttributes::getRandomCompletePayload();
        $payload['abundance'] = 'Królewna śnieżka i 100 murzynów';
        
        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();
        
        $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
    
        $response->assertStatus(400)
                    ->assertJson(["errors" => [trans('validation.exists', ['attribute' => 'abundance'])]]);
    }

    public function testCreateMovieCandidateWithInvalidDuration()
    {
        $payload = MovieCandidatesAttributes::getRandomCompletePayload();
        $payload['duration'] = '-00:000:987777';
        
        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();
        
        $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
    
        $response->assertStatus(400)
                    ->assertJson(["errors" => [trans('validation.date_format', ['attribute' => 'duration', 'format' => 'H:i:s'])]]);
    }

    public function testCreateMovieCandidateWithSexAmmountOutOfRange()
    {
        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();

        foreach(MovieCandidatesAttributes::SEX_TYPES as $sextType)
        {
            $payload = MovieCandidatesAttributes::getMinimumRequiredPayload();
            $belowZero = boolval(rand(1,0));
            $payload[$sextType] = $belowZero ? rand(-234,-1) : rand(101,345);
            $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
            $limitType = $belowZero ? 'min' : 'max';
            $limit = $belowZero ? 1: 100;
            $response->assertStatus(400)
                    ->assertJson(["errors" => [trans('validation.'.$limitType.'.numeric', 
                                ['attribute' => str_replace('_', ' ',$sextType), 
                                $limitType => $limit])]]);
        }
    }

    public function testCreateMovieCandidateWithInvalidCumshotType()
    {
        $payload = MovieCandidatesAttributes::getRandomCompletePayload();
        
        $user = User::factory()
                    ->employeeAllowedToMakeMovieCandidates()
                    ->create();

        $payload['actor_cumshot_type'] = 'in outer space';
        
        $response = $this->actingAs($user)
                    ->postJson(route('movie-candidate.create'), $payload);
    
        $response->assertStatus(400)
                    ->assertJson(["errors" => [trans('validation.exists', ['attribute' => 'actor cumshot type'])]]);
    }
}
