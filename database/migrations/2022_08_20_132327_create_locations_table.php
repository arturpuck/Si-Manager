<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Location;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->char('name',30);
            $table->engine = 'InnoDB';
        });

        Location::insert([
            ['name' => 'house'],
            ['name' => 'bathroom'],
            ['name' => 'office'],
            ['name' => 'school'],
            ['name' => 'public_place'],
            ['name' => 'car'],
            ['name' => 'nature'],
            ['name' => 'solarium'],
            ['name' => 'elevator'],
            ['name' => 'beach'],
            ['name' => 'gym']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
};
