<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\Shop;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class ShopUserRegisterTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test register shop user success.
     *
     * @return void
     */
    public function testRegisterShopUserSuccess()
    {
        $shop = Shop::factory()->create();

        $response = $this->postJson('/api/v1/user/shop', ['shop_id' => $shop->id], $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test register shop user fail.
     *
     * @return void
     */
    public function testRegisterShopUserFail()
    {
        $shop = Shop::factory()->create();

        $response = $this->postJson(
            '/api/v1/user/shop',
            ['shop_id' => $shop->id],
            ['Authorization' => 'Bearer test-fail']
        );
        $response->assertStatus(401);
    }
}
