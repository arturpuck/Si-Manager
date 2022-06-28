<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Movies\MovieCreatorController;
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

Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'showDashboard'])
           ->name('dashboard');

        Route::prefix('/movie')->name('movie.')->middleware(['role:movieCreator'])->group( function () {
            
            Route::get('/creator', [MovieCreatorController::class, 'showMovieCreatorPanel'])
                ->name('creator');

            Route::get('/submit/panel', [MovieCreatorController::class, 'showMovieSubmitPanel'])
                ->name('submit.panel');

            Route::post('', [MovieCreatorController::class, 'addMovieCandidate'])
                  ->name('create');

         });

        Route::prefix('/pornstar')->name('pornstar.')->middleware(['role:movieCreator'])->group( function () {
            Route::get('', [PornstarsController::class, 'getPornstars'])->name('list');
         });

});


require __DIR__.'/auth.php';
