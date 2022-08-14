<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Movies\MovieCandidateController;
use App\Http\Controllers\Movies\MovieController;
use App\Http\Controllers\Pornstars\PornstarsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group( function () {

        Route::get('/dashboard', [DashboardController::class, 'showDashboard'])
           ->name('dashboard');

        Route::middleware(['role:movieCreator'])->group( function () {
            
            
                Route::prefix('/movie-candidate')->name('movie-candidate.')->group(function () {

                        Route::get('/panel', [MovieCandidateController::class, 'showMovieCreatorPanel'])
                        ->name('panel');

                        Route::post('', [MovieCandidateController::class, 'addOrEditMovieCandidate'])
                        ->name('create');

                        Route::put('', [MovieCandidateController::class, 'addOrEditMovieCandidate'])
                        ->name('update');
    
                        Route::get('', [MovieCandidateController::class, 'getPendingMovieCandidates'])
                        ->name('list');

                        Route::delete('', [MovieCandidateController::class, 'deleteMovieCandidate'])
                        ->name('delete');
                    }
                );

        });

        Route::middleware(['role:admin'])->group(function () {

                Route::prefix('/movie')->name('movie.')->group(function () {

                    Route::get('/panel', [MovieController::class, 'showMovieCreationPanel'])
                    ->name('panel');

                    Route::post('', [MovieController::class, 'createMovies'])
                          ->name('create');
                });
        });

        Route::prefix('/pornstar')->name('pornstar.')->middleware(['role:movieCreator'])->group(
            function () {
                Route::get('', [PornstarsController::class, 'getPornstars'])->name('list');
            }
        );

    }
);


require __DIR__.'/auth.php';
