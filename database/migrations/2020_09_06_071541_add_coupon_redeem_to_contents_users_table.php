<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCouponRedeemToContentsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contents_users', function (Blueprint $table) {
            $table->enum('coupon_redeem', ['yes', 'no'])->default('no')->after('content_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contents_users', function (Blueprint $table) {
            $table->dropColumn('coupon_redeem');
        });
    }
}
