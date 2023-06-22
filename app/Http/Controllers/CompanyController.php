<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $validated = $request->validated();
        $image = $request->file('logo');
        $imageName = time(). '.' .$image->getClientOriginalExtension();
        Storage::disk('companies')->put('public', $image);
        $validated['logo'] = 'companies/' .$imageName;
        Company::create($validated);

        return response()->json(['message' => 'Added Successfully']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        return view('companies.form', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);

        $validated = $request->validated();
        $company->email = $validated['email'];
        $company->name = $validated['name'];
        $company->website = $validated['website'];
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = time(). '.'. $image->getClientOriginalExtension();
            Storage::disk('public')->put($imageName, $image);
            $company->logo = "public/". $imageName;
        }
        $company->save();

        return response()->json(['message' => 'Updated Successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return response()->json(['message' => 'Company Deleted Successfully']);
    }

    public function datatable(){
        $companies = Company::latest();

        return DataTables::of($companies)
        ->addColumn('action', function ($row){
            $btn = '<button class="edit btn btn-primary btn-sm company-edit" id='.$row->id.' data-id=' .$row->id. ' edit-url=' .route('companies.edit', $row->id).'>Edit</button>&nbsp&nbsp';
            $btn = $btn.'<button class="edit btn btn-danger btn-sm eg-swal-av3" id='.$row->id.' data-id='.$row->id.' delete-url=' .route('companies.destroy', $row->id ).'>Delete</button>';

            return $btn;
        })
        ->editColumn('logo', function ($row){
            return '<img src="/storage/'.$row->logo.' ">';
        })
        ->rawColumns(['action', 'logo'])
        ->make(true);
    }
}
