<?php
namespace App\Services;

use App\Models\ToDo;
use App\Repositories\ToDoRepository;
use App\Http\Requests\ToDoRequest;
use Illuminate\Http\Request;

class ToDoService
{
    public function __construct(ToDoRepository $toDo)
    {
        $this->toDo = $toDo;
    }

    public function index()
    {
        return $this
            ->toDo
            ->getAllToDos();
    }

    public function getEstimationByCategory($categoryId)
    {
        $estimatedHours = 0;
        return $this
            ->toDo
            ->getEstimationByCategory($categoryId);
    }

    public function getUserToDoById($id)
    {
        return $this->toDo->getUserToDoById($id);
    }


    public function create(ToDoRequest $request)
    {
        $attributes = $request->all();

        return $this
            ->toDo
            ->create($attributes);
    }

    public function read($id)
    {
        return $this
            ->toDo
            ->getToDoById($id);
    }

    public function update( array $collection, $id)
    {

        return $this
            ->toDo
            ->update($id, $collection);
    }

    public function updateStatus( $id, $collection )
    {

        return $this
            ->toDo
            ->updateStatus($id, $collection);
    }

    public function startToDo(array $collection, $id)
    {

        return $this
            ->toDo
            ->startToDo($collection,$id);
    }


    public function delete($id)
    {
        return $this
            ->toDo
            ->deleteToDo($id);
    }
}