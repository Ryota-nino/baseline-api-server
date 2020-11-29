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
            $table->bigInteger('company_information_id')->unsigned();
            $table->text('content');
            $table->bigInteger('posted_year');
            $table->timestamps();

            $table->foreign('company_information_id')->references('id')->on('company_information')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
