<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id')->unsigned()->nullable();
            $table->foreign('channel_id')->references('id')->on('channels');
            $table->string('program_start');
            $table->string('program_end');
            $table->string('title');
            $table->string('subtitle');
            $table->text('description')->nullable()->default(NULL);
            $table->date('date');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('rating_id')->unsigned()->nullable();
            $table->foreign('rating_id')->references('id')->on('ratings');
            $table->text('icon')->nullable()->default(NULL);
            $table->string('icon_type')->nullable()->default(NULL);
            $table->string('year');

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
        Schema::dropIfExists('programs');
    }
}
