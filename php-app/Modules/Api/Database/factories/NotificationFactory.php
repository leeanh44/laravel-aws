<?php
namespace Modules\Api\Database\factories;

use Illuminate\Support\Str;
use Modules\Api\Entities\Shop;
use Modules\Api\Entities\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'shop_id' => Shop::factory()->create()->id,
            'title' => Str::random(10),
            'description' => Str::random(100)
        ];
    }
}
