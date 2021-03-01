<?php
namespace Modules\Api\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Api\Constants\ShopStatus;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Shop;

class ShopFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shop::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'media_id' => Media::factory()->create()->id,
            'name' => Str::random(20),
            'address' => Str::random(200),
            'working_time' => Str::random(20),
            'description' => Str::random(100),
            'status' => ShopStatus::ACTIVE
        ];
    }
}
