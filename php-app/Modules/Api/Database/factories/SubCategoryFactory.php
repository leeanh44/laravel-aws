<?php
namespace Modules\Api\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Api\Constants\SubCategoryStatus;
use Modules\Api\Entities\Category;
use Modules\Api\Entities\SubCategory;

class SubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory()->create()->id,
            'name' => Str::random(20),
            'description' => Str::random(100),
            'order' => 1,
            'status' => SubCategoryStatus::ACTIVE
        ];
    }
}
