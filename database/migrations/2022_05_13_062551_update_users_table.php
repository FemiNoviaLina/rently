<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('address_id')->nullable();
            $table->string('address_mlg')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_1');
            $table->dropColumn('phone_2');
            $table->dropColumn('address_id');
            $table->dropColumn('address_mlg');
        });
    }
};
