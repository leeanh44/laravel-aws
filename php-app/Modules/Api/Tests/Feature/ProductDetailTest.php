<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\Product;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class ProductDetailTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get list product by sub category success.
     *
     * @return void
     */
    public function testProductDetailSuccess()
    {
        $product = Product::factory()->create();

        $response = $this->getJson('/api/v1/products/'. $product->id, $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test get list product by sub category fail.
     *
     * @return void
     */
    public function testProductDetailFail()
    {
        $product = Product::factory()->create();

        $response = $this->getJson(
            '/api/v1/products/'. $product->id,
            ['Authorization' => 'Bearer test-fail']
        );
        $response->assertStatus(401);
    }
}
