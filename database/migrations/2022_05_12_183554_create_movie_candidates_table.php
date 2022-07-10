<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $movieCandidatesTableDefinition = $this->getMovieCandidatesTableDefinition();
        \DB::statement($movieCandidatesTableDefinition);
        \DB::statement('ALTER TABLE movie_candidates AUTO_INCREMENT = 1');

        Schema::table(
            'movie_candidates', function (Blueprint $table) {
                $table->dropColumn('created_at');
                $table->softDeletes();
            }
        );

        Schema::table(
            'movie_candidates', function (Blueprint $table) {
                $table->tinyText('pornstars_list')->nullable()->default(null);
                $table->timestamps();
            }
        );
    }

    protected function getMovieCandidatesTableDefinition() : string {
        $moviesTableDefinition = \DB::select('SHOW CREATE TABLE movies');
        $moviesTableDefinition = $moviesTableDefinition[0]->{"Create Table"};
        return str_replace('movies', 'movie_candidates', $moviesTableDefinition);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_candidates');
    }
};
