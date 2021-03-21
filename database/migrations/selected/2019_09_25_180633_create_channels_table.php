<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('channel_id');
            $table->string('display_name_am');
            $table->string('display_name_en');
            $table->string('display_name_ru');
            $table->text('channel_logo')->nullable()->default(NULL);
            $table->string('channel_logo_type')->nullable()->default(NULL);
            $table->string('utc_offset')->default("+0400");
            $table->integer('archived')->default(0);
            $table->string('epg_url');
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
        Schema::dropIfExists('channels');
    }
}
