<?php

namespace Database\Factories;

use App\Models\Refund;
use Illuminate\Database\Eloquent\Factories\Factory;

class RefundFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Refund::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'=> $this->faker-> randomDigit(),
            'reason'=> $this->faker-> sentence(),
            'status'=> $this->faker->randomElement(['pending', 'review', 'approved']),
            'more_explanation'=> $this->faker-> sentence(),
            'deleted_at'=> $this->faker->date(),
            'suspended_at'=> $this->faker->date()
        ];
    }
}
