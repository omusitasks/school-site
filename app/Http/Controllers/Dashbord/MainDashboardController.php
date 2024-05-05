<?php

namespace App\Http\Controllers\Dashbord;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // for count
use Illuminate\Support\Facades\DB;

class MainDashboardController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dashboard = null;
        // Fetch counts for different roles
        $tutorsCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'tutor');
        })->count();

        $studentCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->count();

        $clientCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();

        $adminCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();

        // fetch count for published blogs
        $publishedBlogsCount = DB::table('par_blogs')->count();

        $coursesCount = DB::table('par_courses')->count();

        // fetch count for projects
        $completedProjectsCount = DB::table('par_projects')
        ->where('name', 'Completed')->count();

        $inProgressProjectsCount = DB::table('par_projects')
        ->where('name', 'In Progress')->count();

        $declinedProjectsCount = DB::table('par_projects')
        ->where('name', 'Declined')->count();

        $rejectedProjectsCount = DB::table('par_projects')
        ->where('name', 'Rejected')->count();

        $acceptedProjectsCount = DB::table('par_projects')
        ->where('name', 'Accepted')->count();


        return view('dashbord.maniDashbord', compact('dashboard',
            'tutorsCount', 'studentCount', 'clientCount', 'adminCount', 'publishedBlogsCount',
            'completedProjectsCount', 'inProgressProjectsCount', 'declinedProjectsCount', 'rejectedProjectsCount', 'acceptedProjectsCount', 'coursesCount'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
