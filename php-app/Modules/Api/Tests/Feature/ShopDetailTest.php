<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Shop;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class ShopDetailTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get detail shop success.
     *
     * @return void
     */
    public function testGetShopDetailSuccess()
    {
        $shop = Shop::factory()->create();

        $response = $this->getJson('/api/v1/shop/'. $shop->id, $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test get detail shop fail.
     *
     * @return void
     */
    public function testGetShopDetailFail()
    {
        $shop = Shop::factory()->create();

        $response = $this->getJson('/api/v1/shop/'. $shop->id, ['Authorization' => 'Bearer test-fail']);
        $response->assertStatus(401);
    }
}
