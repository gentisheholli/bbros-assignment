<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserService
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this
            ->user
            ->getAllUsers();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

        return $this
            ->user
            ->create($attributes);
    }

    public function read($id)
    {
        return $this
            ->user
            ->getUserById($id);
    }

    public function update(Request $request, $id)
    {
        $attributes = $request->all();

        return $this
            ->user
            ->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this
            ->user
            ->deleteUser($id);
    }

    public function getAllUserTodos()
    {
        return $this->user->getAllUserTodos();
    }

    public function getSingleToDo($id)
    {
        return $this->user->getSingleToDo($id);
    }
}