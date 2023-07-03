<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Transformers\CompanyTransformer;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $companies = Company::when($request->keyword, function ($query) use ($request){
            return $query->where('name', 'LIKE', '%'. $request->keyword .'%');
        })->paginate(10);
        return response()->json(['success' => true, 'data' => (new CompanyTransformer())->transform($companies), 'message' => 'Companies retrieved successfully'], 200);

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

    public function companyEmployeesCountFilter(Request $request){
        $companies = Company::has('employees', '>=', $request->count)->with('employees')->paginate(10);
        return response()->json(['success' => true, 'data' => (new CompanyTransformer())->transform($companies), 'message' => 'Data retrieved successfully']);
    }
}
