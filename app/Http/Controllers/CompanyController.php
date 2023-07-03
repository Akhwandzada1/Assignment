<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Jobs\CompanyRegisteredJob;
use Image;
use Illuminate\Support\Str;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(){
        $this->middleware(['permission:create_company'])->only(['create', 'store']);
        $this->middleware(['permission:read_company'])->only(['datatable', 'index']);
        $this->middleware(['permission:update_company'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_company'])->only(['destroy']);
    }

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
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $resizedImage = Image::make($image)->resize(200, 100)->encode();
        Storage::disk('public')->put('companies/' . $filename, $resizedImage);
        $validated['logo'] = Str::after(Storage::path($filename), "app");
        Company::create($validated);
        CompanyRegisteredJob::dispatch();

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
        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $resizedImage = Image::make($image)->resize(200, 100)->encode();
            Storage::disk('public')->put('companies/' . $filename, $resizedImage);
            $validated['logo'] = Str::after(Storage::path($filename), "app");
        }
        $company->update($validated);

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
            $btn = '';
            if(auth()->user()->hasPermissionTo('update_company')){
                $btn .= '<button class="edit btn btn-primary btn-sm company-edit " id='.$row->id.' data-id=' .$row->id. ' edit-url=' .route('companies.edit', $row->id).'>Edit</button>';
            }
            if(auth()->user()->hasPermissionTo('delete_company')){
                $btn .= '<button class="edit btn btn-danger btn-sm eg-swal-av3 delete-confirmation" id='.$row->id.' data-id='.$row->id.' delete-url=' .route('companies.destroy', $row->id ).'>Delete</button>';         
            }
            return $btn;
        })
        ->editColumn('logo', function ($row){
            return '<img src="/storage/companies'.$row->logo.' ">';
        })
        ->rawColumns(['action', 'logo'])
        ->make(true);
    }
}
