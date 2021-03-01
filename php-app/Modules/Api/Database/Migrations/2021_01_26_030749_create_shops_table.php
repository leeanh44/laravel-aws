<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Api\Constants\ShopStatus;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('working_time')->nullable();
            $table->text('description')->nullable();
            $table->string('status', 50)->default(ShopStatus::ACTIVE);
            $table->timestamps();

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
        Schema::dropIfExists('shops');
    }
}
