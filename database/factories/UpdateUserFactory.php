<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UpdateUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name'=> $this->faker-> firstName,
            'middle_name'=> $this->faker-> firstName,
            'last_name'=> $this->faker-> lastName,
            'user_name'=> $this->faker->unique()->userName ,
            'email'=> $this->faker->unique()->safeEmail,
            'phone'=> $this->faker->phoneNumber,
            'address'=> $this->faker->address ,
            'password'=> $this->faker->password,
            'biography'=> $this->faker->paragraph,
            'id_number'=> $this->faker->unique()->numerify('######'),
            'passport_no'=> $this->faker->unique()->numerify('##-##-###') ,
            'dob'=> $this->faker->date(),
            'city'=> $this->faker->city ,
            'postal_code'=> $this->faker->postcode,
            'physical_address'=> $this->faker->address,
            'email_verified_at'=> $this->faker->date(),
            'id_verified_at'=> $this->faker->date() ,
            'gender'=> $this->faker->randomDigit,
            'nationality'=> $this->faker->country(),
            'avatar'=> $this->faker->word,
            
            // 'remember_token' => Str::random(10)

        ];
    }
}
