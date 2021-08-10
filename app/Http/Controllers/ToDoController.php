<?php
namespace App\Http\Controllers;

use App\Models\ToDo;
use Illuminate\Http\Request;
use App\Http\Requests\ToDoRequest;
use App\Services\ToDoService;

class ToDoController extends Controller
{
    protected $toDo;

    public function __construct(ToDoService $toDo)
    {
        $this->toDo = $toDo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toDos = $this
            ->toDo
            ->index();

        if (count($toDos) < 1)
        {
            return response()->json(['error' => 'No to do found.'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDos]);
    }

    public function getEstimationByCategory($categoryId){
        $toDos = $this
            ->toDo
            ->getEstimationByCategory($categoryId);

        if ($toDos < 1)
        {
            return response()->json(['error' => 'No estimation found.'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ToDoRequest $request)
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToDoRequest $request)
    {
        $toDo = $this
            ->toDo
            ->create($request);

        return response()->json(['status'=>200,'data'=>$toDo]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PageBuilder  $pageBuilder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDo = $this
            ->toDo
            ->read($id);

        if (!$toDo)
        {
            return response()->json(['error' => 'To do was not found'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDo]);
        
    }

 
    public function userToDo($id)
    {
        
        $toDo = $this
            ->toDo
            ->getUserToDoById($id);

        if (!$toDo)
        {
            return response()->json(['error' => 'You do not have any to do.'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDo]);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PageBuilder  $pageBuilder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PageBuilder  $pageBuilder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $toDo = $this
        ->toDo
        ->read($id);

        if(!$toDo){
            return response()->json(['error' => 'To do was not found'], 404);
        }


		$input = $request->all();
      
		$toDo->fill($input)->save();
		return response()->json(["data" => $toDo->toArray(),"message" => "To do was updated successfully."]);
    }

    public function updateStatus(Request $request, $id)
    {

        $toDo = $this
        ->toDo
        ->read($id);

        if(!$toDo){
            return response()->json(['error' => 'To do was not found'], 404);
        }


		$input = $request->only('status');

        $toDo = $this
        ->toDo
        ->updateStatus($input,$id);
        

		return response()->json(["data" => $toDo,"message" => "To do was updated successfully."]);
    }

    public function startToDo(Request $request, $id)
    {

        $toDo = $this
        ->toDo
        ->read($id);

        if(!$toDo){
            return response()->json(['error' => 'To do was not found'], 404);
        }


		$input = $request->only('status');

        $toDo = $this
        ->toDo
        ->startToDo($input,$id);
        

		return response()->json(["data" => $toDo,"message" => "To do was updated successfully."]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PageBuilder  $pageBuilder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $toDo = $this
        ->toDo
        ->read($id);

        if (!$toDo){
            return response()->json(['error' => 'To do was not found.'], 404);
        }

        $toDo = $this
        ->toDo
        ->delete($id);

        return response()->json(['status'=>200,'msg'=>'To do deleted successfully.']);

    }
}