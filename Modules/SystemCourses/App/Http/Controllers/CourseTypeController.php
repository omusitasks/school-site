<?php

namespace Modules\SystemCourses\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View; // Import View facade

use Carbon\Carbon; // Import the Carbon library for time
use App\Models\User; // for count
use Illuminate\Support\Facades\Storage; // for file system image storage uploads

class CourseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursetypes = DB::table('par_course_types')->latest()->get();

        return view('dashbord.CoursesModule.coursetypes.index', compact('coursetypes'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $coursetype = DB::table('par_course_types')
                ->join('users', 'par_course_types.created_by', '=', 'users.id')
                ->select('par_course_types.*', 'users.name as author')
                ->where('par_course_types.id', $id)
                ->first();

    if (!$coursetype) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($coursetype->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.CoursesModule.coursetypes.show', compact('coursetype', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.CoursesModule.coursetypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255|unique:par_course_types', // Add the unique rule here
        'description' => 'nullable|string|max:1000',
        'code' => 'nullable|string',
    ]);

    DB::table('par_course_types')->insert([
        'name' => $request->name,
        'description' => $request->description,
        'code' => $request->code,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Course Type created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $coursetypes = DB::table('par_course_types')->find($id);

        // Check if the blog exists
        if (!$coursetypes) {
            abort(404);
        }

        return view('dashbord.CoursesModule.coursetypes.edit', compact('coursetypes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_course_types,name,' . $id, // Add unique rule for updating
            'description' => 'nullable|string|max:1000',
            'code' => 'nullable|string',
        ]);

        $tag = DB::table('par_course_types')->find($id);

        if (!$tag) {
            abort(404);
        }

        DB::table('par_course_types')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'code' => $request->code,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Course Type updated successfully', 'success');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_course_types')->where('id', $id)->delete();

    return $this->returnMessage('Course types record deleted successfully', 'success');
    }
}
