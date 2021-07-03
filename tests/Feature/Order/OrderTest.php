<?php

namespace Tests\Feature\Order;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use App\Models\Order;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * A basic feature test can fetch orders using GET
     *
     * @return void
     */
    public function test_can_fetch_orders()
    {
        Order::factory()->create();
        $response = $this->get('v1/order')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
    
    /**
     * A basic feature test can create an order .
     *
     * @return void
     */
    public function test_can_create_an_order()
    {
        Order::factory()->create();
        $order = Order::first();
        $response = $this->get('v1/order/'.$order->id);
        $response ->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ]);
    }

    
    /**
     * A basic feature test can get an order using GET.
     *
     * @return void
     */
    public function test_can_get_an_order()
    {         
        Order::factory()->create(); 
        $order = Order::first();
        $response = $this->get('v1/order/'.$order->id);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    ]);                   
    }

    
    /**
     * A basic feature test can update an order using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_an_order()
    {   $this->withoutExceptionHandling();    
        Order::factory()->create();
        $order = Order::first();

        $updateData= @json_decode(json_encode(Order::Factory()->create()), true);
        $response = $this->json('PUT', 'v1/order/'.$order->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                    'success' => true,
                    ]);                  
    }
    
    /**
     * A basic feature test can delete an order using DELETE.
     *
     * @return void
     */
    public function test_can_delete_an_order()
    {       
        Order::factory()->create();
        $order = Order::first();
        
        $response = $this->json('DELETE', 'v1/order/'.$order->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }


}
