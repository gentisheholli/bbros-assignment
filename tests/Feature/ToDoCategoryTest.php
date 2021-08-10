<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ToDoCategoryTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_user_can_read_all_the_categories()
    {
        //Given we have category in the database
        $category = factory('App\Models\ToDoCategory')->create();

        //When user visit the category page
        $response = $this->get('to-do-categories');
        
        //He should be able to read the category
        $response->assertSee($category->name);
    }

    public function a_user_can_read_single_category()
    {
    //Given we have category in the database
    $category = factory('App\Models\ToDoCategory')->create();
    //When user visit the category's URI
    $response = $this->get('/category/'.$category->id);
    //He can see the category details
    $response->assertSee($category->name)
        ->assertSee($category->status);
    }

    public function authenticated_users_can_create_a_new_category()
{
    //Given we have an authenticated user
    $this->actingAs(factory('App\Models\User')->create());
    //And a category object
    $user = factory('App\Models\User')->make();
    //When user submits post request to create category endpoint
    $this->post('to-do-category',$user->toArray());
    //It gets stored in the database
    $this->assertEquals(1,ToDoCategory::all()->count());
}


public function a_category_requires_a_name(){

    $this->actingAs(factory('App\Models\User')->create());

    $category = factory('App\Models\ToDoCategory')->make(['name' => null]);

    $this->post('to-do-category',$category->toArray())
            ->assertSessionHasErrors('name');
}

public function authorized_user_can_update_the_category(){

    //Given we have a signed in user
    $this->actingAs(factory('App\Models\User')->create());
    //And a category which is created by the user
    $category = factory('App\Models\ToDoCategory')->create(['user_id' => Auth::id()]);
    $category->name = "Updated Name";
    //When the user hit's the endpoint to update the category
    $this->patch('to-do-category/'.$category->id, $category->toArray());
    //The category should be updated in the database.
    $this->assertDatabaseHas('to_do_categories',['id'=> $category->id , 'name' => 'Updated Name']);

}
}