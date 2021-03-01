<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Api\Constants\ShopBannerStatus;

class CreateShopBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_banners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('media_id');
            $table->unsignedTinyInteger('order');
            $table->string('status', 50)->default(ShopBannerStatus::ACTIVE);
            $table->timestamps();

            $table->foreign('shop_id')
                ->references('id')->on('shops')
                ->onDelete('cascade');
            $table->foreign('media_id')
                ->references('id')->on('medias')
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
        Schema::dropIfExists('shop_banners');
    }
}
