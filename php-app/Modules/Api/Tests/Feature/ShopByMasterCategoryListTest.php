<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\MasterCategory;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Shop;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class ShopByMasterCategoryListTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get list shop by category success.
     *
     * @return void
     */
    public function testGetListShopByCategorySuccess()
    {
        $media = Media::factory()->create();
        $masterCategory = MasterCategory::factory()->state(['media_id' => $media->id])->create();
        $shop = Shop::factory()->create();
        $masterCategory->shops()->sync([$shop->id]);

        $response = $this->getJson(
            '/api/v1/master-category/'. $masterCategory->id .'/shops',
            $this->headersWithToken()
        );
        $response->assertStatus(200);
    }

    /**
     * Feature test get list shop by category fail.
     *
     * @return void
     */
    public function testGetListShopByCategoryFail()
    {
        $media = Media::factory()->create();
        $masterCategory = MasterCategory::factory()->state(['media_id' => $media->id])->create();

        $response = $this->getJson(
            '/api/v1/master-category/'. $masterCategory->id .'/shops',
            ['Authorization' => 'Bearer test-fail']
        );
        $response->assertStatus(401);
    }
}
