<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Api\Constants\NotificationStatus;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('delivery_at')->nullable();
            $table->string('status', 50)->default(NotificationStatus::ACTIVE);
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
        Schema::dropIfExists('notifications');
    }
}
