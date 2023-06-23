<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
        $this->middleware(['permission:create_employee'])->only(['create', 'store']);
        $this->middleware(['permission:read_employee'])->only(['datatable', 'index']);
        $this->middleware(['permission:update_employee'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_employee'])->only(['destroy']);
    }
    public function index()
    {
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        return view('employees.form', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        Employee::create($request->validated());

        return response()->json(['message' => 'Employee Created Successfully']);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $employee = Employee::findOrFail($id);

        return view('employees.form', compact('companies', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $validated = $request->validated();
        $employee->update($validated);

        return response()->json(['message' => 'Employee Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(['message' => 'Employee Deleted Successfully']);
    }

    public function datatable(){
        $employees = Employee::with('company')->latest();

        return Datatables::of($employees)
        ->addColumn('action', function ($row){
            $btn = '';
            if(auth()->user()->hasPermissionTo('update_employee')){
                $btn .= '<button class="edit btn btn-primary btn-sm employee-edit " id='.$row->id.' data-id=' .$row->id. ' edit-url=' .route('employees.edit', $row->id).'>Edit</button>&nbsp&nbsp';
            }
            if(auth()->user()->hasPermissionTo('delete_employee')){
                $btn .= '<button class="edit btn btn-danger btn-sm eg-swal-av3" id='.$row->id.' data-id='.$row->id.' delete-url=' .route('employees.destroy', $row->id ).'>Delete</button>';         
            }
            return $btn;
        })
        ->editColumn('company', function ($row){
            return $row->company->name;
        })
        ->rawColumns(['action', 'company'])
        ->make(true);
    }
}
