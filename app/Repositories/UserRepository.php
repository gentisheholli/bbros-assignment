<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\ToDo;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $user;

    public function __construct(User $user, ToDo $todo)
    {
        $this->user = $user;
        $this->todo = $todo;
    }

    public function getAllUsers()
    {
        return $this
            ->user
            ->get();
    }

    public function getUserById($id)
    {
        return $this
            ->user
            ->where('id', $id)->get();
    }

    public function createOrUpdate($id = null, $collection = [])
    {
        if (is_null($id))
        {
            $user = new $this->user;
            $user->name = $collection['name'];
            $user->email = $collection['email'];
            $user->password = Hash::make('password');
            $user->save();

        }
        $user = $this
            ->user
        ->find($id);
        $user->name = $collection['name'];
        $user->email = $collection['email'];
        $user->save();

    }

    
    public function getAllUserTodos()
    {
        $user = Auth::user()->id;

        return $this
        ->todo
        ->where('user_id', $user)->get();
    }

    public function getSingleToDo($id)
    {
        $user = Auth::user()->id;

        return $this
        ->todo
        ->where('id', $id)->where('user_id',$user)->first();
    }




    public function deleteUser($id)
    {
       $user = $this->getUserById($id);
        return $user->delete();
    }
}

