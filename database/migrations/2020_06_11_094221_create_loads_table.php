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
            $table->string('title');
            $table->text('description');
            $table->mediumText('pickup');
            $table->mediumText('delivery');
            $table->string('truck_type');
            $table->json('images');
            $table->string('status')->default('open');
            $table->integer('driver')->nullable();
            $table->boolean('load_type');
            $table->decimal('budget', 10, 2);
            $table->decimal('price', 10, 2)->nullable();
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
    }
}
