<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id');
            $table->string('artist');
            $table->string('castandcrew');
            $table->text('description');
            $table->string('banner_image');
            $table->string('content_link')->nullable();
            $table->string('format')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->enum('status', ['active', 'inactive']);
            $table->enum('publish', ['no', 'yes']);
            $table->enum('monetize', ['no', 'yes']);
            $table->string('language');
            $table->string('genres');
            $table->json('tags')->nullable();
            $table->json('display_tags')->nullable();
            $table->enum('privacy', ['no', 'yes']);
            $table->json('privacy_parameters')->nullable();
            $table->enum('go_live_status', ['no', 'yes']);
            $table->dateTime('go_live_date')->nullable();
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
        Schema::dropIfExists('contents');
    }
}
