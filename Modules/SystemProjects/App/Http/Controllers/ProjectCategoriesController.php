<?php

namespace Modules\SystemProjects\App\Http\Controllers;

use Modules\SystemProjects\app\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import the Carbon library

class ProjectCategoriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project_categories = DB::table('par_project_categories')->latest()->get();

        return view('dashbord.ProjectModule.ProjectCategories.index', compact('project_categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project_categories = DB::table('par_project_categories')
                            ->join('users', 'par_project_categories.created_by', '=', 'users.id')
                            ->select('par_project_categories.*', 'users.name as author')
                            ->where('par_project_categories.id', $id)
                            ->first();

        if (!$project_categories) {
            abort(404);
        }

        // Calculate the duration since the project category was created using Carbon
        $createdDate = Carbon::parse($project_categories->created_at);
        $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

        return view('dashbord.ProjectModule.ProjectCategories.show', compact('project_categories', 'duration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.ProjectModule.ProjectCategories.create');
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

        DB::table('par_project_categories')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return $this->returnMessage('Project category created successfully', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project_categories = DB::table('par_project_categories')->find($id);

        if (!$project_categories) {
            abort(404);
        }

        return view('dashbord.ProjectModule.ProjectCategories.edit', compact('project_categories'));
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

        $project_categories = DB::table('par_project_categories')->find($id);

        if (!$project_categories) {
            abort(404);
        }

        DB::table('par_project_categories')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Project category updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('par_project_categories')->where('id', $id)->delete();

        return $this->returnMessage('Project category deleted successfully', 'success');
    }
}
