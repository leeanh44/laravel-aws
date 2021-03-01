<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\Notification;
use Modules\Api\Entities\Shop;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class NotificationListByShopTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get list notification by shop success.
     *
     * @return void
     */
    public function testGetNotificationDetailSuccess()
    {
        $shop = Shop::factory()->create();
        $notification = Notification::factory()->state(['shop_id' => $shop->id])->create();

        $response = $this->getJson('/api/v1/shop/'. $shop->id .'/notifications', $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test get list notification by shop fail.
     *
     * @return void
     */
    public function testGetNotificationDetailFail()
    {
        $shop = Shop::factory()->create();
        $notification = Notification::factory()->create();

        $response = $this->getJson(
            '/api/v1/shop/'. $shop->id .'/notifications',
            ['Authorization' => 'Bearer test-fail']
        );
        $response->assertStatus(401);
    }
}
