<?php
namespace App\Repositories;
use App\Models\ToDo;
use App\Models\User;
use Auth;
use DateTime;
Use Carbon\Carbon;

class ToDoRepository 
{   
    protected $toDo;

    public function __construct(ToDo $toDo)
    {
        $this->toDo = $toDo;
    }


    public function getAllToDos()
    {
        return $this->toDo->get();
    }

    public function getEstimationByCategory($categoryId)
    {
        $categories = $this->toDo->where('category_id',$categoryId)->get();
        $estimatedMinutes = 0;
            foreach($categories as $toDoCategory){
              
                $mins = Carbon::parse($toDoCategory->estimated_completion_time)->diffInMinutes(Carbon::parse($toDoCategory->created_at));
                $estimatedMinutes+=$mins;
            }
            $estimatedHours = $estimatedMinutes/60;

        return $estimatedHours;
    
    }

    public function getToDoById($id)
    {
        return $this->toDo->where('id', $id)->first();
    }

    public function create($collection)
    {   
        $toDo = new $this->toDo;
        $toDo->title = $collection['title'];
        $toDo->subtitle =  $collection['subtitle'];
        $toDo->description = $collection['description'];
        $toDo->status = 1;
        $toDo->start_time = $collection['start_time'];
        $toDo->end_time =  $collection['end_time'];
        $toDo->estimated_completion_time = $collection['estimated_completion_time'];
        $toDo->overdue =  0;
        $toDo->completion_time = $collection['completion_time'];
        $toDo->user_id =  auth()->user()->id;
        $toDo->category_id =  $collection['category_id'];
    
        return $toDo->save();
    }

    public function startToDo($id){
        $user = Auth::user()->id;

        $toDo = $this->toDo->where('id', $id)->where('user_id',$user)->first();
        if($toDo){
            $toDo->start_time = Carbon::now()->format('Y-m-d H:i:s');
            $toDo->status = 2;
        }

        return $toDo->save();
    }

    public function updateStatus(array $collection,$id){
        $user = Auth::user()->id;
      
        $toDo = $this->toDo->where('id', $id)->where('user_id',$user)->first();
        if($toDo){
            $toDo->status = $collection['status'];

            if($collection['status'] == 3 ){
                if($toDo->updated_at < $toDo->estimated_completion_time){
                    $toDo->end_time = Carbon::now()->format('Y-m-d H:i:s');
                    $toDo->overdue = 0;
                }
                else{
                    $toDo->end_time = Carbon::now()->format('Y-m-d H:i:s');
                    $toDo->overdue = 1;
                }
            }

            if($collection['status'] == 2){
                if($toDo->updated_at < $toDo->estimated_completion_time){
                    $toDo->end_time = null;
                    $toDo->overdue = 0;
                }
                else{
                    $toDo->end_time = null;
                    $toDo->overdue = 1;
                }
            }

            return $toDo->update($collection);
        }
    }

    public function update(array $collection, $id)
    {
        $user = Auth::user()->id;

        $toDo = $this->toDo->where('id', $id)->where('user_id',$user)->first();

        if($toDo){
            $toDo->title = $collection['title'];
            $toDo->subtitle =  $collection['subtitle'];
            $toDo->description = $collection['description'];
            $toDo->estimated_completion_time = $collection['estimated_completion_time'];
            $toDo->category_id =  $collection['category_id'];
   
            return $toDo->update($collection);
        }

        else{
            return;
        }
    }

    
    public function deleteToDo($id)
    {
        $userId = auth()->user()->id;
        $toDo = $this->toDo->where('id', $id)->where('user_id',$userId)->first();

        if($toDo){
            return $this->getToDoById($id)->delete();
        }
        return;
    }
}