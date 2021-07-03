<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;
    /**
     * A basic feature test can fetch users using GET.
     *
     * @return void
     */
    public function test_can_fetch_users()
    {
        Passport::actingAs( User::factory()->create() );
        $response = $this->get('v1/users')
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    /**
     * A basic feature test can create a user .
     *
     * @return void
     */
    public function test_can_create_user()
    {
        Passport::actingAs( User::factory()->create());
        $user = User::first();
        $response = $this->get('v1/users/'.$user->id);
        $response ->assertStatus(200)
                ->assertJson([
                    'success' => true,
                ]);
    }


    /**
     * A basic feature test can get a user using GET.
     *
     * @return void
     */
    public function test_can_get_a_user()
    {         
        Passport::actingAs( User::factory()->create() ); 
        $user = User::first();
        $response = $this->get('v1/users/'.$user->id);
        $response->assertStatus(200)
                ->assertJson([
                    'success' => true,
                    ]);                   
    }


    /**
     * A basic feature test can update a user using PUT/PATCH.
     *
     * @return void
     */
    public function test_can_update_a_user()
    {       
        Passport::actingAs( User::factory()->create() );
        $user = User::first();

        $updateData = $this->updateUserDataHelper();
        $response = $this->json('PUT', 'v1/users/'.$user->id, $updateData); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }

    /**
     * A basic feature test can delete a user using DELETE.
     *
     * @return void
     */
    public function test_can_delete_a_user()
    {       
        Passport::actingAs( User::factory()->create() );
        $user = User::first();
        
        $response = $this->json('DELETE', 'v1/users/'.$user->id); 
        $response->assertStatus(200)
                    ->assertJson([
                        'success' => true,
                        ]);                  
    }


     /**
     * user data helper
     * 
     * @param string $role
     * @return array
    */
    private function userDataHelper($role){
        return[
            'full_name'=> "Jon Doe JD",
            'role'=> $role,
            'user_name'=> "jonDoe01",
            'email'=> "jonDoe@gmail.com",
            'phone'=> "012365478",
            'address'=> "7th strt califonia",
            'password'=> 'nkkKK566.,lkjhu',  
            'password_again'=> 'nkkKK566.,lkjhu',
            'biography'=> 'biography biogrpgy',
            'id_number'=> 21366598,
            'passport_no'=> 'asdf366',
            'dob'=> '2021-02-15T21:20:22',
            'city'=> 'nairobi',
            'postal_code'=> 'f1255ffk',
            'physical_address'=> '67 k strt',
            'suspended_at'=> '2021-02-15T21:20:22',
            'email_verified_at'=> '2021-02-15T21:20:22',
            'id_verified_at'=> '2021-02-15T21:20:22',
            'gender'=> 2,
            'marital_status'=> 2,
            'kra_pin'=> 'rr66r12r',
            'nhif_no'=> '32265',
            'nssf_no'=> '22665',
            'job_id'=> '3336',
            'nationality'=> 'kenyan',
            'employment_date'=> '2021-02-15T21:20:22',
            'termination_date'=> '2021-02-15T21:20:22',
            'approved_by'=> 2,
            'supervisor_id'=> '33326',
            'registered_by'=> 2,
            'suspended_by'=> 2,
            'avatar'=> 'kokonn'
        ];
    }

     /**
     * update user data helper
     * 
     * @param string $role
     * @return array
    */
    private function updateUserDataHelper(){
        return[
            'first_name'=> 'Jon',
            'middle_name'=> 'Doe',
            'last_name'=>  'JD',
            'user_name'=> 'jonDoe01',
            'email'=> 'jonDoe@gmail23.com',
            'phone'=> "0790643963",
            'address'=> '7th strt califonia',
            'biography'=> 'biography biogrpgy',
            'id_number'=> 213665983,
            'passport_no'=> 'asdf366',
            'dob'=> '2021-02-15T21:20:22',
            'city'=> 'nairobi',
            'postal_code'=> 'f1255ffk',
            'physical_address'=> '67 k strt',
            'suspended_at'=> '2021-02-15T21:20:22',
            'email_verified_at'=> '2021-02-15T21:20:22',
            'id_verified_at'=> '2021-02-15T21:20:22',
            'gender'=> 2,
            'marital_status'=> 2,
            'kra_pin'=> 'rr66r12r',
            'nhif_no'=> '32265j',
            'nssf_no'=> '22665j',
            'job_id'=> '3336j',
            'nationality'=> 'kenyan',
            'employment_date'=> '2021-02-15T21:20:22',
            'termination_date'=> '2021-02-15T21:20:22',
            'approved_by'=> 2,
            'supervisor_id'=> '33326',
            'registered_by'=> 2,
            'suspended_by'=> 2,
            'avatar'=> 'kokonjn'
        ];
    }

}
