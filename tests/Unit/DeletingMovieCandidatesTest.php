<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\MovieCandidate;
use App\Models\User;

class DeletingMovieCandidatesTest extends TestCase
{
    use RefreshDatabase;
    
    public function testDeleteSingleMovieCandidate()
    {
        $movieCandidate = MovieCandidate::factory()
                                         ->create();

        $user = User::factory()
            ->employeeAllowedToMakeMovieCandidates()
            ->create();

        $url = route('movie-candidate.delete').'?id='.$movieCandidate->id;

        $response = $this->actingAs($user)
            ->deleteJson($url);

        $response->assertStatus(200)
            ->assertJson(['id' => $movieCandidate->id]);
    }

    public function testDeleteAllMovieCandidates()
    {
        $movieCandidates = MovieCandidate::factory()
            ->count(rand(1, 20))
            ->create();

        $movieCandidatesIDs = $movieCandidates->pluck('id')
                                              ->toArray();

        $user = User::factory()
            ->employeeAllowedToMakeMovieCandidates()
            ->create();

        $url = route('movie-candidate.delete').'?id=all';

        $response = $this->actingAs($user)
            ->deleteJson($url);
                
        $response->assertStatus(200)
            ->assertJson(['id' => $movieCandidatesIDs]);
    }
}
