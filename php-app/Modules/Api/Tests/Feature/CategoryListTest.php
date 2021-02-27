<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\Category;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Shop;
use Modules\Api\Entities\SubCategory;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class CategoryListTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get list by shop success.
     *
     * @return void
     */
    public function testGetListByShopSuccess()
    {
        $shop = Shop::factory()->create();
        $category = Category::factory()->state(['shop_id' => $shop->id])->create();
        $media = Media::factory()->create();
        SubCategory::factory()->state(['category_id' => $category->id, 'media_id' => $media->id])->create();
        SubCategory::factory()->state(['category_id' => $category->id, 'media_id' => $media->id])->create();

        $response = $this->getJson('/api/v1/shop/'. $shop->id .'/categories', $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test get list by shop fail.
     *
     * @return void
     */
    public function testGetListByShopFail()
    {
        $shop = Shop::factory()->create();
        $category = Category::factory()->state(['shop_id' => $shop->id])->create();
        $media = Media::factory()->create();
        SubCategory::factory()->state(['category_id' => $category->id, 'media_id' => $media->id])->create();
        SubCategory::factory()->state(['category_id' => $category->id, 'media_id' => $media->id])->create();

        $response = $this->getJson('/api/v1/shop/'. $shop->id .'/categories', ['Authorization' => 'Bearer test-fail']);
        $response->assertStatus(401);
    }
}
