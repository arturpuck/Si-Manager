<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_candidates', function (Blueprint $table) {
            $table->id();
            $table->tinyText('actress_tits_size')->nullable()->default(null);
            $table->tinyText('actress_ass_size')->nullable()->default(null);
            $table->tinyText('actress_thickness')->nullable()->default(null);
            $table->tinyText('actress_hair_color')->nullable()->default(null);
            $table->tinyText('actress_age_range')->nullable()->default(null);
            $table->tinyText('actress_race')->nullable()->default(null);
            $table->boolean('shows_shaved_pussy')->nullable()->default(null);
            $table->foreignId('actress_nationality_id')->nullable()->references('id')->on('nationalities');
            $table->foreignId('action_location_id')->nullable()->references('id')->on('locations')->default(null);
            $table->foreignId('story_or_costume_type_id')->nullable()->references('id')->on('story_or_costume_types');
            $table->boolean('is_professional_production')->nullable()->default(null);
            $table->tinyText('camera_style');
            $table->tinyText('pornstars_list')->nullable()->default(null);
            $table->tinyText('abundance');
            $table->tinyInteger('anal_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('blowjob_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('pussy_fuck_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('handjob_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('tittfuck_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('pussy_licking_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('feet_petting_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('position_69_percentage')->nullable()->default(null)->unsigned();
            $table->tinyInteger('double_penetration_percentage')->nullable()->default(null)->unsigned();
            $table->tinyText('actor_cumshot_type')->nullable()->default(null);
            $table->boolean('is_cumshot_compilation_type')->nullable()->default(null);
            $table->boolean('actress_has_pantyhose')->nullable()->default(null);
            $table->boolean('has_story')->nullable()->default(null);
            $table->boolean('actress_has_stockings')->nullable()->default(null);
            $table->boolean('shows_whips')->nullable()->default(null);
            $table->boolean('actress_has_glasses')->nullable()->default(null);
            $table->boolean('shows_sex_toys')->nullable()->default(null);
            $table->boolean('shows_high_heels')->nullable()->default(null);
            $table->boolean('shows_big_cock')->nullable()->default(null);
            $table->boolean('recorded_by_spy_camera')->nullable()->default(null);
            $table->boolean('is_sadistic_or_masochistic')->nullable()->default(null);
            $table->boolean('is_female_domination_type')->nullable()->default(null);
            $table->boolean('shows_latex')->nullable()->default(null);
            $table->boolean('is_translated_to_polish')->nullable()->default(null);
            $table->time('duration');
            $table->text('description')->nullable()->default(null);
            $table->tinyText('title');
            $table->softDeletes();
            $table->timestamps();
        });
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
