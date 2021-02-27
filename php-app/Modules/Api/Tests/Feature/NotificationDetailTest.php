<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\Notification;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class NotificationDetailTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get detail notification success.
     *
     * @return void
     */
    public function testGetNotificationDetailSuccess()
    {
        $notification = Notification::factory()->create();

        $response = $this->getJson('/api/v1/notification/'. $notification->id, $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test get detail notification fail.
     *
     * @return void
     */
    public function testGetNotificationDetailFail()
    {
        $notification = Notification::factory()->create();

        $response = $this->getJson('/api/v1/notification/'. $notification->id, ['Authorization' => 'Bearer test-fail']);
        $response->assertStatus(401);
    }
}
