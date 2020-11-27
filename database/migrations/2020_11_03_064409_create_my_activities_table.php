<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_activities', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->bigInteger('posted_year');
            $table->bigInteger('posted_by')->unsigned();
            $table->timestamps();

            $table->foreign('posted_by')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_activities');
    }
}
