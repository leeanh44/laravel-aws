<?php
namespace Modules\Api\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Api\Entities\Media;

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(10),
            'type' => Str::random(20),
            'path' => Str::random(5),
            'size' => Str::random(5),
        ];
    }
}
