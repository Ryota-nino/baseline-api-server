<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InterviewContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('interview_id')->unsigned();
            $table->text('content');

            $table->foreign('interview_id')->references('id')->on('interviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
