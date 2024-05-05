<?php

namespace Modules\SystemProjects\App\Http\Controllers;

use Modules\SystemProjects\app\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import the Carbon library


class ProjectStatusController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project_status = DB::table('par_project_status')->latest()->get();

        return view('dashbord.ProjectModule.projectstatus.index', compact('project_status'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $project_status = DB::table('par_project_status')
            ->join('users', 'par_project_status.created_by', '=', 'users.id')
            ->select('par_project_status.*', 'users.name as author')
            ->where('par_project_status.id', $id)
            ->first();

        if (!$project_status) {
            abort(404);
        }

        $createdDate = Carbon::parse($project_status->created_at);
        $duration = $createdDate->diffForHumans();

        return view('dashbord.ProjectModule.projectstatus.show', compact('project_status', 'duration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.ProjectModule.projectstatus.create');
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

        DB::table('par_project_status')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'created_by' => auth()->id(),
            'created_at' => now(),
        ]);

        return $this->returnMessage('Project status created successfully', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project_status = DB::table('par_project_status')->find($id);

        if (!$project_status) {
            abort(404);
        }

        return view('dashbord.ProjectModule.projectstatus.edit', compact('project_status'));
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

        $project_status = DB::table('par_project_status')->find($id);

        if (!$project_status) {
            abort(404);
        }

        DB::table('par_project_status')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Project status updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('par_project_status')->where('id', $id)->delete();

        return $this->returnMessage('Project status deleted successfully', 'success');
    }

}
