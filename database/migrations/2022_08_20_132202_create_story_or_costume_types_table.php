<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\StoryOrCostumeType;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('story_or_costume_types', function (Blueprint $table) {
            $table->id();
            $table->char('name',30);
        });

        StoryOrCostumeType::insert([
            ['name' => 'female_pupil'],
            ['name' => 'female_employee'],
            ['name' => 'female_student'],
            ['name' => 'wife'],
            ['name' => 'female_teacher'],
            ['name' => 'nurse'],
            ['name' => 'female_slave'],
            ['name' => 'nun'],
            ['name' => 'female_police_officer'],
            ['name' => 'prostitute'],
            ['name' => 'female_boss'],
            ['name' => 'cleaner'],
            ['name' => 'mommy'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('story_or_costume_types');
    }
};
