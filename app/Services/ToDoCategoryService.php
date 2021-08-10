<?php
namespace App\Services;

use App\Models\ToDoCategory;
use App\Repositories\ToDoCategoryRepository;
use Illuminate\Http\Request;

class ToDoCategoryService
{
    public function __construct(ToDoCategoryRepository $toDoCategory)
    {
        $this->toDoCategory = $toDoCategory;
    }

    public function index()
    {
        return $this
            ->toDoCategory
            ->getAllCategories();
    }

    public function create(Request $request)
    {
        $attributes = $request->all();

        return $this
            ->toDoCategory
            ->create($attributes);
    }

    public function read($id)
    {
        return $this
            ->toDoCategory
            ->getCategoryById($id);
    }

    public function update($collection, $id)
    {
        return $this
            ->toDoCategory
            ->update($collection,$id);
    }

    public function delete($id)
    {
        return $this
            ->toDoCategory
            ->deleteCategory($id);
    }
}