<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
             'user_id'=> $this->faker-> randomDigit(),
             'topic'=> $this->faker-> sentence(),
             'type'=> $this->faker-> word(),
             'deadline'=> $this->faker->date(),
             'paper_type'=> $this->faker->word(),
             'quantity'=> $this->faker->randomDigit(),
             'spacing'=> $this->faker->word(),
             'status'=> $this->faker->randomElement(['complete', 'onhold', 'inprogress', 'revisions']),
             'pages'=> $this->faker->randomDigit(),
             'words'=> $this->faker->randomDigit(),
             'academic_level'=> $this->faker->sentence(),
             'instructions'=> $this->faker->paragraph(),
             'formating_style'=> $this->faker->word(),
             'number_of_sources'=> $this->faker->randomDigit(),
             //'sample_file'=> $this->faker->mimeType(),
             'deleted_at'=> $this->faker->date(),
             'suspended_at'=> $this->faker->date()
        ];
    }
}
