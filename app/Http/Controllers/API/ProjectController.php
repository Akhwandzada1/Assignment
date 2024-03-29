<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Transformers\ProjectTransformer;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    public function index(Request $request)
    {
            $projects = Project::when($request->keyword, function ($query) use ($request){
                return $query->where('name', 'LIKE', '%'.$request->keyword.'%');
            })
            ->when($request->employeeName, function ($query) use ($request){
                return $query->whereHas('employees', function ($query) use ($request){
                    return $query->where('first_name', 'LIKE', '%'. $request->employeeName .'%')
                    ->orWhere('last_name', 'LIKE', '%'. $request->employeeName .'%');
                });
            })
            ->paginate(10);
            return response()->json(['success' => true, 'data' => (new ProjectTransformer())->transform($projects), 'message' => 'Projects retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}