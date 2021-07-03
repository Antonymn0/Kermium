<?php

namespace Tests\Feature\Payment;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Payment;

class PaymentTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * A basic feature test can fetch payments using GET
     *
     * @return void
     */
    public function test_can_fetch_payments()
    {
        Payment::factory()->create();
        $response = $this->get('v1/payment')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

     /**
     * A basic feature test can create a payment .
     *
     * @return void
     */
    public function test_can_create_a_payment()
    {
        Payment::factory()->create();
        $payment = Payment::first();
        $response = $this->get('v1/payment/'.$payment->id);
        $response ->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ]);
    }
    
    /**
     * A basic feature test can get a payment using GET.
     *
     * @return void
     */
    public function test_can_get_a_payment()
    {         
        Payment::factory()->create(); 
        $payment = Payment::first();
        $response = $this->get('v1/payment/'.$payment->id);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    ]);                   
    }
    
    /**
     * A basic feature test can update a payment using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_a_payment()
    {    
        $this->withoutExceptionHandling();    
        Payment::factory()->create();
    	$payment = Payment::first();

        $updateData= @json_decode(json_encode(Payment::Factory()->create()), true);
        $response = $this->json('PUT', 'v1/payment/'.$payment->id, $updateData); 
        
        $response->assertStatus(200)
                    ->assertJson([
                    'success' => true,
                    ]);                  
    }
    
    /**
     * A basic feature test can delete a payment using DELETE.
     *
     * @return void
     */
    public function test_can_delete_a_payment()
    {       
        Payment::factory()->create();
        $payment = Payment::first();
        
        $response = $this->json('DELETE', 'v1/payment/'.$payment->id); 
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    ]);                  
    }

    
}
