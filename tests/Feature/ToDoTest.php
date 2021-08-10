<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ToDoTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    public function a_user_can_read_all_the_todos()
    {
        //Given we have todo in the database
        $toDo = factory('App\Models\ToDo')->create();

        //When user visit the todo page
        $response = $this->get('to-dos');
        
        //He should be able to read the to do
        $response->assertSee($toDo->title);
    }

    public function a_user_can_read_single_todo()
    {
    //Given we have to do in the database
    $toDo = factory('App\Models\ToDo')->create();
    //When user visit the to do's URI
    $response = $this->get('/to-do/'.$toDo->id);
    //He can see the to do details
    $response->assertSee($toDo->title)
        ->assertSee($toDo->status);
    }

    public function authenticated_users_can_create_a_new_todo()
{
    //Given we have an authenticated user
    $this->actingAs(factory('App\Models\User')->create());
    //And a todo object
    $user = factory('App\Models\User')->make();
    //When user submits post request to create to do endpoint
    $this->post('to-do',$user->toArray());
    //It gets stored in the database
    $this->assertEquals(1,ToDo::all()->count());
}


public function a_todo_requires_a_subtitle(){

    $this->actingAs(factory('App\Models\User')->create());

    $toDo = factory('App\Models\Todo')->make(['subtitle' => null]);

    $this->post('to-do',$toDo->toArray())
            ->assertSessionHasErrors('subtitle');
}

public function authorized_user_can_update_the_todo(){

    //Given we have a signed in user
    $this->actingAs(factory('App\Models\User')->create());
    //And a to do which is created by the user
    $toDo = factory('App\Models\ToDo')->create(['user_id' => Auth::id()]);
    $toDo->description = "Updated Description";
    //When the user hit's the endpoint to update the todo
    $this->patch('to-do/'.$toDo->id, $toDo->toArray());
    //The to do should be updated in the database.
    $this->assertDatabaseHas('to-dos',['id'=> $toDo->id , 'description' => 'Updated Description']);

}
}