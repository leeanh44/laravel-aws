<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Shop;
use Modules\Api\Entities\Category;
use Modules\Api\Entities\SubCategory;
use Modules\Api\Entities\Product;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class ProductBySubCategoryListTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get list product by sub category success.
     *
     * @return void
     */
    public function testProductBySubCategorySuccess()
    {
        $shop = Shop::factory()->create();
        $category = Category::factory()->state(['shop_id' => $shop->id])->create();
        $media = Media::factory()->create();
        $subCategory = SubCategory::factory()->state([
            'category_id' => $category->id,
            'media_id' => $media->id
        ])->create();
        Product::factory(['sub_category_id' => $subCategory->id])->create();

        $response = $this->getJson('/api/v1/products/sub-category/'. $subCategory->id, $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test get list product by sub category fail.
     *
     * @return void
     */
    public function testProductBySubCategoryFail()
    {
        $shop = Shop::factory()->create();
        $category = Category::factory()->state(['shop_id' => $shop->id])->create();
        $media = Media::factory()->create();
        $subCategory = SubCategory::factory()->state([
            'category_id' => $category->id,
            'media_id' => $media->id
        ])->create();
        Product::factory(['sub_category_id' => $subCategory->id])->create();

        $response = $this->getJson(
            '/api/v1/products/sub-category/'. $shop->id,
            ['Authorization' => 'Bearer test-fail']
        );
        $response->assertStatus(401);
    }
}
