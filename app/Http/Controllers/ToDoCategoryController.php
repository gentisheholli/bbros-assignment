<?php
namespace App\Http\Controllers;

use App\Models\ToDoCategory;
use Illuminate\Http\Request;
use App\Http\Requests\ToDoCategoryRequest;
use App\Services\ToDoCategoryService;

class ToDoCategoryController extends Controller
{
    protected $toDoCategory;

    public function __construct(ToDoCategoryService $toDoCategory)
    {
        $this->toDoCategory = $toDoCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toDoCategories = $this
            ->toDoCategory
            ->index();

        if (count($toDoCategories) < 1)
        {
            return response()->json(['error' => 'No category found.'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDoCategories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ToDoCategoryRequest $request)
    {   
        $toDoCategory = $this
            ->toDoCategory
            ->create($request);

        return response()->json(['status'=>200,'data'=>$toDoCategory]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PageBuilder  $pageBuilder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $toDoCategory = $this
            ->toDoCategory
            ->read($id);

        if (!$toDoCategory)
        {
            return response()->json(['error' => 'Category was not found'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDoCategory]);
        
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
		 $toDoCategory = $this
        ->toDoCategory
        ->read($id);
		$input = $request->all();
		$toDoCategory->fill($input)->save();

		return response()->json(["data" => $toDoCategory->toArray(),"message" => "To do category was updated successfully."]);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PageBuilder  $pageBuilder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $toDoCategory = $this
        ->toDoCategory
        ->read($id);

        if (!$toDoCategory){
            return response()->json(['error' => 'Category was not found.'], 404);
        }

        $toDoCategory = $this
        ->toDoCategory
        ->delete($id);

        return response()->json(['status'=>200,'msg'=>'Category deleted successfully.']);

    }
}