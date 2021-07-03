<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id'=>$this->faker->randomDigitNotZero() ,
            'method'=>$this->faker->word(),
            'status'=> $this->faker->word() ,
            'currency'=> $this->faker->word() ,
            'shipping_cost'=> $this->faker->randomFloat(1),
            'total_due'=> $this->faker->randomFloat(1) ,
            'total_payable'=> $this->faker->randomFloat(1),
            'discount_rate'=>$this->faker->randomFloat(1) ,
            'discount_amount'=> $this->faker->randomFloat(1),
            'payment_due_date'=>$this->faker->date() ,
            'interest_rate'=>$this->faker->randomFloat(1) ,
            'account_ref'=> $this->faker->word() ,
            'tansaction_desc'=>$this->faker->sentence(),
            'phone_number'=> '123654' ,
            'merchant_request_id'=> '1' ,
            'checkout_request_id'=>'2'  ,
            'response_code'=> '2',
            'response_message'=> $this->faker->word() ,
            'coupon_code'=> $this->faker->word(),
            'deleted_at'=> $this->faker->date(), 
            'suspended_at'=> $this->faker->date()
        ];
    }
}
