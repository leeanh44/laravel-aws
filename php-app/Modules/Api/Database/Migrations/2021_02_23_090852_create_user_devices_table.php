<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Api\Constants\UserDeviceStatus;

class CreateUserDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('device_id', 100)->unique();
            $table->string('device_token', 255)->nullable();
            $table->string('device_os', 100)->nullable();
            $table->string('device_name', 100)->nullable();
            $table->string('device_os_version', 100)->nullable();
            $table->string('app_version', 20)->nullable();
            $table->string('status', 50)->default(UserDeviceStatus::ACTIVE);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('user_devices');
    }
}
