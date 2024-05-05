<?php

namespace Modules\SystemCourses\app\Http\Controllers;

use Modules\SystemCourses\app\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library for time
use App\Models\User; // for count
use Illuminate\Support\Facades\Storage; // for file system image storage uploads

class CourseController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $courses = DB::table('par_courses')
        ->join('par_course_categories', 'par_courses.course_categories_id', '=', 'par_course_categories.id')
        ->join('par_course_types', 'par_courses.course_types_id', '=', 'par_course_types.id')
        ->join('users', 'par_courses.created_by', '=', 'users.id')
        ->select('par_courses.*', 'par_course_categories.name as course_category_name', 'par_course_types.name as course_type_name', 'users.name as author')
        ->latest()
        ->get();

        return view('dashbord.CoursesModule.courses.index', compact('courses'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course = DB::table('par_courses')
        ->join('par_course_categories', 'par_courses.course_categories_id', '=', 'par_course_categories.id')
        ->join('par_course_types', 'par_courses.course_types_id', '=', 'par_course_types.id')
        ->join('users', 'par_courses.created_by', '=', 'users.id')
        ->select('par_courses.*', 'par_course_categories.name as course_category_name', 'par_course_types.name as course_type_name', 'users.name as author')
        ->where('par_courses.id', $id)
        ->first();

    if (!$course) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($course->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.CoursesModule.courses.show', compact('course', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coursetypes = DB::table('par_course_types')->get();
        $course_categories = DB::table('par_course_categories')->get();
        return view('dashbord.CoursesModule.courses.create', compact('coursetypes', 'course_categories'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_courses', // Add the unique rule here
            'description' => 'nullable|string|max:10000',
            'code' => 'nullable|string',
            'course_image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'course_types_id' => 'required|integer',
            'course_categories_id' => 'required|integer',
            'subscription_fee' => 'nullable|integer',
        ]);

        // Get the image file from the request
        $image = $request->file('course_image_path');

        // Check if an image was uploaded
        if ($image) {
            // Define the folder path where the image will be stored
            $folderPath = 'public/courses';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Insert the image path into the database
            DB::table('par_courses')->insert([
                'name' => $request->name,
                'course_image_path' => $folderPath . '/' . $imageName,
                'description' => $request->description,
                'code' => $request->code,
                'course_types_id' => $request->course_types_id,
                'course_categories_id' => $request->course_categories_id,
                'subscription_fee' => $request->subscription_fee,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            return $this->returnMessage('Course record created successfully', 'success');
        }

        // Handle the case where no image was uploaded
        return $this->returnMessage('No course  was uploaded', 'error');
    }




    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $courses = DB::table('par_courses')->find($id);
        $coursetypes = DB::table('par_course_types')->get();
        $course_categories = DB::table('par_course_categories')->get();

        // Check if the blog exists
        if (!$courses) {
            abort(404);
        }

        return view('dashbord.CoursesModule.courses.edit', compact('courses', 'coursetypes', 'course_categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_courses,name,' . $id, // Add unique rule for updating
            'description' => 'required|string|max:1000',
            'course_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image to be nullable for updating
            'code' => 'nullable|string',
            'course_types_id' => 'required|integer',
            'course_categories_id' => 'required|integer',
            'subscription_fee' => 'nullable|integer',
        ]);

        $course = DB::table('par_courses')->find($id);

        if (!$course) {
            abort(404);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'course_types_id' => $request->course_types_id,
            'course_categories_id' => $request->course_categories_id,
            'subscription_fee' => $request->subscription_fee,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        // Check if a new image was uploaded
        if ($request->hasFile('course_image_path')) {
            // Get the image file from the request
            $image = $request->file('course_image_path');

            // Define the folder path where the image will be stored
            $folderPath = 'public/courses';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Set the new image path in the data array
            $data['course_image_path'] = $folderPath . '/' . $imageName;
        }

        // Update the course$course_category record
        DB::table('par_courses')
            ->where('id', $id)
            ->update($data);

        return $this->returnMessage('Course record updated successfully', 'success');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_courses')->where('id', $id)->delete();

    return $this->returnMessage('Course record deleted successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function defstroy()
    {
        $course = DB::table('par_courses')->where('id', $id)->delete();
        // Additional logic for user deletion (if needed)

        $course->delete();

        return redirect('/')->with('status', 'account-deleted');
    }

}
