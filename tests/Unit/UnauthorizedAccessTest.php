<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\MovieCandidate;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnauthorizedAccessTest extends TestCase
{
    use RefreshDatabase;
   
    public function testAttemtToSeePanelWithoutLogin()
    {
        $response = $this->get(route('dashboard'));
        $response->assertStatus(302);
    }

    public function testUserWithoutMovieCreatorRoleWantsToSeeCreatorPanel()
    {
        $user = User::factory()
            ->create();

        $response = $this->actingAs($user)
                            ->get(route('movie-candidate.panel'));

        $response->assertStatus(403);
    }

    public function testUserThatIsNotAdminWantsToSeeAcceptPanel()
    {
        $user = User::factory()
            ->create();

        $response = $this->actingAs($user)
                            ->get(route('movie.panel'));

        $response->assertStatus(403);
    }

    public function testUserThatIsNotAdminWantsToCreateMovie()
    {
        $user = User::factory()
            ->create();
        
        $movieCandidate = MovieCandidate::factory()
                                        ->count(rand(1,4))
                                        ->create();

        $movieCandidatesIDs = $movieCandidate->pluck('id')->toArray();
        $payload = ['candidates_ids' => $movieCandidatesIDs];
        

        $response = $this->actingAs($user)
                ->postJson(route('movie.create'), $payload);
        
        $response->assertStatus(403);
    }

    public function testUserThatIsNotMovieCreatorWantsToDeleteMovieCandidate()
    {
        $user = User::factory()
            ->create();
        
        $movieCandidate = MovieCandidate::factory()
                                        ->create();

        $payload = ['id' => $movieCandidate->id];
        

        $response = $this->actingAs($user)
                ->deleteJson(route('movie-candidate.delete'), $payload);
        
        $response->assertStatus(403);
    }
}
