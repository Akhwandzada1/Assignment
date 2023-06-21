<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCompanyRequest;
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddCompanyRequest $request)
    {
        $validated = $request->validated();
        $image = $request->file('logo');
        $imageName = time(). '-' .$image->getClientOriginalExtension();
        Storage::disk('public')->put($imageName, $image);
        $company = new Company;
        $company->email = $validated['email'];
        $company->name = $validated['name'];
        $company->website = $validated['website'];
        $company->logo = "public/". $imageName;
        $company->save();

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function datatable(){
        $companies = Company::latest();

        return DataTables::of($companies)->make(true);
    }
}
