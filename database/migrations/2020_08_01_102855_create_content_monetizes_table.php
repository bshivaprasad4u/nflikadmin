<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentMonetizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_monetizes', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->string('currency');
            $table->string('giftcoupon_image');
            $table->enum('status', ['active', 'inactive']);
            $table->foreignId('content_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
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
        Schema::dropIfExists('content_monetizes');
    }
}
