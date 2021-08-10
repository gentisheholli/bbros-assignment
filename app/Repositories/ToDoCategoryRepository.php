<?php
namespace App\Repositories;
use App\Models\ToDoCategory;

class ToDoCategoryRepository 
{   
    protected $toDoCategory;

    public function __construct(ToDoCategory $toDoCategory)
    {
        $this->toDoCategory = $toDoCategory;
    }


    public function getAllCategories()
    {
        return $this->toDoCategory->get();
    }

    public function getCategoryById($id)
    {
        return $this->toDoCategory->where('id', $id)->first();
    }

    public function getCategoryByStatus($status)
    {
        return $this->toDoCategory->where('status', $status)->get();
    }

    public function create($collection)
    {
        $toDoCategory = new $this->toDoCategory;
        $toDoCategory->name = $collection['name'];
        $toDoCategory->status =  $collection['status'];
    
        return $toDoCategory->save();
    }

    public function update( array $collection, $id)
    {
        $toDoCategory = $this->toDoCategory->find($id);
       return $toDoCategory->update($collection);

    }

    
    public function deleteCategory($id)
    {
       return $this->getCategoryById($id)->delete();
    }
}