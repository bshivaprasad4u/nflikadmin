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
            $table->string('duration')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->enum('status', ['active', 'inactive']);
            $table->enum('publish', ['no', 'yes']);
            $table->enum('monetize', ['no', 'yes']);
            $table->string('language');
            $table->string('genres');
            $table->json('tags')->nullable();
            $table->json('display_tags')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->json('privacy_settings')->nullable();
            $table->enum('go_live_status', ['no', 'yes']);
            $table->dateTime('go_live_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('clients')->onDelete('cascade');
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
