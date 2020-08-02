<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('channel_FBpage')->nullable();
            $table->string('channel_Twitterpage')->nullable();
            $table->string('channel_Instagrampage')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->string('subdomain')->nullable();
            $table->string('watermark')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
