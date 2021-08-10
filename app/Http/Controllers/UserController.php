<?php
namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this
            ->userService
            ->index();

        if (count($users)< 1)
        {
            return response()->json(['error' => 'No user found.'], 404);
        }

        return response()->json(['status'=>200,'data'=>$users]);

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
    public function store(UserRequest $request)
    {
        $user = $this
            ->userService
            ->create($request);

        return response()->json(['status'=>200,'data'=>$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileManagement  $fileManagement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this
            ->userService
            ->read($id);

        if (!$user)
        {
            return response()->json(['error' => 'User was not found'], 404);
        }
      
        
        return response()->json(['status'=>200,'data'=>$user]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileManagement  $fileManagement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileManagement  $fileManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $this
            ->userService
            ->update($request, $id);

            if(!$user){
                return response()->json(['error' => 'User was not found'], 404);
            }
        
            $user = $this
                ->userService
                ->update($request, $id);
    
            return response()->json(['status'=>200,'data'=>$user]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileManagement  $fileManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $user = $this
            ->userService
            ->read($id);

            if (!$user){
                return response()->json(['error' => 'User was not found.'], 404);
            }
    
            $user = $this
            ->userService
            ->delete($id);
    
            return response()->json(['status'=>200,'msg'=>'User deleted successfully.']);
    }

    public function userToDos()
    {
        $toDo = $this
            ->userService
            ->getAllUserTodos();
        if (!$toDo)
        {
            return response()->json(['error' => 'You do not have any to do.'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDo]);
        
    }

    public function singleUserToDo($id)
    {
        $toDo = $this
            ->userService
            ->getSingleToDo($id);
        if (!$toDo)
        {
            return response()->json(['error' => 'You have no To do with this id.'], 404);
        }

        return response()->json(['status'=>200,'data'=>$toDo]);
        
    }



}