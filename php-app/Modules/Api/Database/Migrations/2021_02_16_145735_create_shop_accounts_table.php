<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('role', 50);
            $table->string('name', 100)->nullable();
            $table->string('account', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('shop_id')
                  ->references('id')->on('shops')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_accounts');
    }
}
