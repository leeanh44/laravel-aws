<?php

namespace Modules\Api\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Api\Entities\MasterCategory;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Shop;
use Modules\Api\Tests\Helpers\UserTokenService;
use Tests\TestCase;

class MasterCategoryListTest extends TestCase
{
    use DatabaseMigrations;
    use UserTokenService;

    /**
     * Feature test get list success.
     *
     * @return void
     */
    public function testGetListSuccess()
    {
        $media = Media::factory()->create();
        $masterCategory = MasterCategory::factory()->state(['media_id' => $media->id])->create();

        $response = $this->getJson('/api/v1/categories', $this->headersWithToken());
        $response->assertStatus(200);
    }

    /**
     * Feature test get list fail.
     *
     * @return void
     */
    public function testGetListFail()
    {
        $response = $this->getJson('/api/v1/categories', ['Authorization' => 'Bearer test-fail']);
        $response->assertStatus(401);
    }
}
