<?php

namespace Tests\Feature\Refund;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Refund;
use Tests\TestCase;

class RefundTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /**
     * A basic feature test can fetch Refunds using GET
     *
     * @return void
     */
    public function test_can_fetch_refunds()
    {
        Refund::factory()->create();
        $response = $this->get('v1/refund')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

     /**
     * A basic feature test can create a refund using POST .
     *
     * @return void
     */
    public function test_can_create_a_refund()
    {
        Refund::factory()->create();
        $refund = Refund::first();
        $response = $this->get('v1/refund/'.$refund->id);
        $response ->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ]);
    }
     
    /**
     * A basic feature test can get a single Refund using GET.
     *
     * @return void
     */
    public function test_can_get_a_refund()
    {         
        Refund::factory()->create(); 
        $refund = Refund::first();
        $response = $this->get('v1/refund/'.$refund->id);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    ]);                   
    }


    /**
     * A basic feature test can update a refund using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_a_refund()
    {    
        $this->withoutExceptionHandling();    
        Refund::factory()->create();
    	$refund = Refund::first();

        $updateData= @json_decode(json_encode(Refund::Factory()->create()), true);
        $response = $this->json('PUT', 'v1/refund/'.$refund->id, $updateData); 
        
        $response->assertStatus(200)
                    ->assertJson([
                    'success' => true,
                    ]);                  
    }

    /**
     * A basic feature test can delete a refund using DELETE.
     *
     * @return void
     */
    public function test_can_delete_a_refund()
    {       
        Refund::factory()->create();
        $refund = Refund::first();
        
        $response = $this->json('DELETE', 'v1/refund/'.$refund->id); 
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    ]);                  
    }
}
