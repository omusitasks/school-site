<?php

namespace Modules\SystemProjects\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import the Carbon library


class ProjectTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projecttypes = DB::table('par_project_types')->latest()->get();

        return view('dashbord.ProjectModule.projecttypes.index', compact('projecttypes'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $projecttype = DB::table('par_project_types')
                        ->join('users', 'par_project_types.created_by', '=', 'users.id')
                        ->select('par_project_types.*', 'users.name as author')
                        ->where('par_project_types.id', $id)
                        ->first();

        if (!$projecttype) {
            abort(404);
        }

        // Calculate the duration since the project type was created using Carbon
        $createdDate = Carbon::parse($projecttype->created_at);
        $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

        return view('dashbord.ProjectModule.projecttypes.show', compact('projecttype', 'duration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.ProjectModule.projecttypes.create');
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

        DB::table('par_project_types')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return $this->returnMessage('Project type created successfully', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $projecttype = DB::table('par_project_types')->find($id);

        if (!$projecttype) {
            abort(404);
        }

        return view('dashbord.ProjectModule.projecttypes.edit', compact('projecttype'));
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

        $projecttype = DB::table('par_project_types')->find($id);

        if (!$projecttype) {
            abort(404);
        }

        DB::table('par_project_types')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Project type updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('par_project_types')->where('id', $id)->delete();

        return $this->returnMessage('Project type deleted successfully', 'success');
    }
}
