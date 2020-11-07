<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmploymentStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_statuses', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('official_offer')->unsigned();
            $table->bigInteger('decision_offer')->unsigned();
            $table->string('occupational_categories_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('users');
            $table->primary(['company_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employment_statuses');
    }
}
