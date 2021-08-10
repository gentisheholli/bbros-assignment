<?php

namespace tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function show_all_users()
    {
        //Given we have user in the database
        $user = factory('App\Models\user')->create();

        //When admin visit the users page
        $response = $this->get('users');
        
        //He should be able to read the user
        $response->assertSee($user->name);
    }

    public function show_single_user()
    {
    //Given we have user in the database
    $user = factory('App\Models\user')->create();
    //When admin visit the user's URI
    $response = $this->get('/user/'.$user->id);
    //He can see the user details
    $response->assertSee($user->name)
        ->assertSee($user->email);
    }


public function a_user_requires_a_name(){

    $this->actingAs(factory('App\Models\User')->create());

    $user = factory('App\Models\User')->make(['name' => null]);

    $this->post('user',$user->toArray())
            ->assertSessionHasErrors('name');
}

}