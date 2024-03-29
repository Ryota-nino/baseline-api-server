<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_information', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->bigInteger('internship_id')->unsigned()->nullable();
            $table->bigInteger('occupational_category_id')->unsigned()->nullable();

            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('company_id')->references('id')->on('companies')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('internship_id')->references('id')->on('internships')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('occupational_category_id')->references('id')->on('occupational_categories')
                ->cascadeOnUpdate()->cascadeOnDelete();


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
        Schema::dropIfExists('company_information');
    }
}
