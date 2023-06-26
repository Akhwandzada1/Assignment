<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:create_project'])->only(['create', 'store']);
        $this->middleware(['permission:read_project'])->only(['datatable', 'index']);
        $this->middleware(['permission:update_project'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_project'])->only(['destroy']);
    }

    public function index()
    {
        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        Project::create($request->validated());

        return response()->json(['message' => 'Project Created Successfully']);
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
        $project = Project::findOrFail($id);
        return view('projects.form', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->validated());

        return response()->json(['message' => 'Project Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(['message' => 'Project Deleted Successfully']);
    }

    public function datatable(){
        $projects = Project::query();

        return DataTables::of($projects)
        ->addColumn('action', function ($row){
            $btn = '';
            if(auth()->user()->hasPermissionTo('update_project')){
                $btn .= '<button class="edit btn btn-primary btn-sm project-edit " id='.$row->id.' data-id=' .$row->id. ' edit-url=' .route('projects.edit', $row->id).'>Edit</button>';
            }
            if(auth()->user()->hasPermissionTo('delete_project')){
                $btn .= '<button class="edit btn btn-danger btn-sm eg-swal-av3 delete-confirmation" id='.$row->id.' data-id='.$row->id.' delete-url=' .route('projects.destroy', $row->id ).'>Delete</button>';         
            }
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
}
