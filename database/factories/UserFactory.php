<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
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
            'full_name'=> $this->faker-> name(),
            'first_name'=> $this->faker-> firstName(),
            'role'=> $this->faker-> jobTitle(),
            'img'=> 'https://www.seekpng.com/ima/u2y3q8t4t4i1q8u2/',
            'middle_name'=> $this->faker-> firstName(),
            'last_name'=> $this->faker-> lastName(),
            'user_name'=> $this->faker->unique()->userName(),
            'email'=> $this->faker->unique()->safeEmail(),
            'phone'=> $this->faker->phoneNumber(),
            'address'=> $this->faker->address() ,
            'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'biography'=> $this->faker->sentence,
            'id_number'=> $this->faker->unique()->numerify('######'),
            'passport_no'=> $this->faker->unique()->numerify('##-##-###') ,
            'dob'=> $this->faker->date(),
            'city'=> $this->faker->city() ,
            'postal_code'=> $this->faker->postcode(),
            'physical_address'=> $this->faker->address() ,
            'suspended_at'=> $this->faker-> date() ,
            'email_verified_at'=> $this->faker->date(),
            'id_verified_at'=> $this->faker->date() ,
            'gender'=> $this->faker->randomDigit,
            'nationality'=> $this->faker->country(),
            'approved_by'=> $this->faker-> randomDigit(),
            'registered_by'=> $this->faker->randomDigit() ,
            'suspended_by'=> $this->faker-> randomDigit(),
            'avatar'=> $this->faker->word(),
            'remember_token' =>$this->faker->bothify('??####?????###-??')                     
              ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
