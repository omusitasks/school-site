<?php

namespace Modules\SystemProjects\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import the Carbon library

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = DB::table('par_projects')
                        ->join('par_project_categories', 'par_projects.project_categories_id', '=', 'par_project_categories.id')
                        ->join('par_project_status', 'par_projects.project_status_id', '=', 'par_project_status.id')
                        ->join('par_project_types', 'par_projects.project_types_id', '=', 'par_project_types.id')
                        ->select('par_projects.*', 'par_project_categories.name as category_name', 'par_project_status.name as status_name', 'par_project_types.name as type_name' )
                        ->latest()
                        ->get();

        return view('dashbord.ProjectModule.projects.index', compact('projects'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = DB::table('par_projects')
                        ->join('users', 'par_projects.created_by', '=', 'users.id')
                        ->join('par_project_status', 'par_projects.project_status_id', '=', 'par_project_status.id')
                        ->join('par_project_categories', 'par_projects.project_categories_id', '=', 'par_project_categories.id')
                        ->join('par_project_types', 'par_projects.project_types_id', '=', 'par_project_types.id')
                        ->select('par_projects.*', 'users.name as author', 'par_projects.created_at', 'par_projects.updated_at', 'par_project_status.name as status_name', 'par_project_categories.name as category_name', 'par_project_types.name as type_name' )
                        ->where('par_projects.id', $id)
                        ->first();

        if (!$project) {
            abort(404);
        }

        // Calculate the duration since the project was created using Carbon
        $createdDate = Carbon::parse($project->created_at);
        $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

        return view('dashbord.ProjectModule.projects.show', compact('project', 'duration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $project_categories = DB::table('par_project_categories')->get();
        $project_status = DB::table('par_project_status')->get();
        $project_types = DB::table('par_project_types')->get();
        return view('dashbord.ProjectModule.projects.create', compact('project_categories', 'project_status', 'project_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        DB::table('par_projects')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'project_categories_id' => $request->project_categories_id,
            'project_status_id' => $request->project_status_id,
            'project_types_id' => $request->project_types_id,
                'project_budget' => $request->project_budget,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return $this->returnMessage('Project created successfully', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = DB::table('par_projects')->find($id);

        if (!$project) {
            abort(404);
        }

        $projectCategories = DB::table('par_project_categories')->get();
        $projectStatuses = DB::table('par_project_status')->get();

        return view('dashbord.ProjectModule.projects.edit', compact('project', 'projectCategories', 'projectStatuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = DB::table('par_projects')->find($id);

        if (!$project) {
            abort(404);
        }

        DB::table('par_projects')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'project_categories_id' => $request->project_categories_id,
                'project_status_id' => $request->project_status_id,
                'project_types_id' => $request->project_types_id,
                'project_budget' => $request->project_budget,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Project updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('par_projects')->where('id', $id)->delete();

        return $this->returnMessage('Project deleted successfully', 'success');
    }
    
}