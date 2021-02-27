<?php
namespace Modules\Api\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Api\Constants\ProductStatus;
use Modules\Api\Entities\SubCategory;
use Modules\Api\Entities\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'sub_category_id' => SubCategory::factory()->create()->id,
            'name' => Str::random(20),
            'description' => Str::random(100),
            'status' => ProductStatus::ACTIVE
        ];
    }
}
