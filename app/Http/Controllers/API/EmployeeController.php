<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Transformers\EmployeeTransformer;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        $employees = Employee::when($request->keyword, function ($query) use ($request){
            return $query->where(function ($query) use ($request){
                return $query->where('first_name', $request->keyword) 
                ->orWhere('last_name', $request->keyword)
                ->orWhere('email', $request->keyword)
                ->orWhere('phone', $request->keyword);
            });
        })
        ->when($request->companyName, function ($query) use ($request){
            return $query->whereHas('company', function ($query) use ($request){
                return $query->where('name', $request->companyName);
            });
        })
        ->when($request->projectName, function ($query) use ($request){
            return $query->whereHas('projects', function ($query) use ($request){
                return $query->where('name', $request->projectName);
            });
        })
        ->when($request->projectCount, function ($query) use ($request){
            return $query->has('projects', '>=', $request->projectCount);
        })
        ->with('company', 'projects')->paginate(10);

        return response()->json(['success' => true, 'data' => (new EmployeeTransformer())->transform($employees), 'message' => 'Data retrieved successfully'], 200);
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
