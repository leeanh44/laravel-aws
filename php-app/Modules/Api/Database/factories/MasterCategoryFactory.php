<?php
namespace Modules\Api\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Api\Constants\MasterCategoryStatus;
use Modules\Api\Entities\MasterCategory;
use Modules\Api\Entities\Media;
use Modules\Api\Entities\Relationships\MasterCategoryRelationship;

class MasterCategoryFactory extends Factory
{
    use MasterCategoryRelationship;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MasterCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'media_id' => Media::factory()->create()->id,
            'name' => Str::random(10),
            'status' => MasterCategoryStatus::ACTIVE,
            'order' => 1
        ];
    }
}
