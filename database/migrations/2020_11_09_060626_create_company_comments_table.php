<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_comments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_information_id')->unsigned();
            $table->text('comment_content');

            $table->foreign('company_information_id')->references('id')->on('company_information')->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_comments');
    }
}
