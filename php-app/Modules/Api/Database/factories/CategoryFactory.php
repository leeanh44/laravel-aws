<?php
namespace Modules\Api\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Api\Constants\CategoryStatus;
use Modules\Api\Entities\Category;
use Modules\Api\Entities\Shop;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'shop_id' => Shop::factory()->create()->id,
            'name' => Str::random(10),
            'status' => CategoryStatus::ACTIVE,
            'order' => 1
        ];
    }
}
