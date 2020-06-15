<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loads', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference');
            $table->integer('user');
            $table->mediumText('pickup');
            $table->mediumText('delivery');
            $table->string('truck_type');
            $table->string('status')->default('open');
            $table->integer('driver')->nullable();
            $table->boolean('isPremium');
            $table->decimal('price')->nullable();
            $table->timestamps();
        });

        Schema::create('loadsImage', function (Blueprint $table) {
            $table->id();
            $table->uuid('load');
            $table->integer('image');
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
        Schema::dropIfExists('loads');
        Schema::dropIfExists('loadsImage');
    }
}
