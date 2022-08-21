<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Nationality;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->id();
            $table->char('name',30);
            $table->engine = 'InnoDB';
        });

        Nationality::insert([
            ['name' => 'american'],
            ['name' => 'japanese'],
            ['name' => 'german'],
            ['name' => 'czech'],
            ['name' => 'russian'],
            ['name' => 'british'],
            ['name' => 'swedish'],
            ['name' => 'ukrainian'],
            ['name' => 'slovac'],
            ['name' => 'hanguarian'],
            ['name' => 'polish'],
            ['name' => 'dutch'],
            ['name' => 'hindu'],
            ['name' => 'french'],
            ['name' => 'spanish'],
            ['name' => 'italian'],
            ['name' => 'canadian'],
            ['name' => 'argentinian'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalities');
    }
};
