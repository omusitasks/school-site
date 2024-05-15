<?php

namespace Modules\SystemCourses\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import the Carbon library for time
use App\Models\User; // for count
use Illuminate\Support\Facades\Storage; // for file system image storage uploads

class CourseCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course_categories = DB::table('par_course_categories')->latest()->get();

        // // Convert BLOB data to base64 encoded strings
        // foreach ($course_categories as $course_category) {
        //     $course_category->image = 'data:image/jpeg;base64,' . base64_encode($course_category->course_category_image_path);
        // }

        return view('dashbord.CoursesModule.coursecategories.index', compact('course_categories'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $course_category = DB::table('par_course_categories')
                ->join('users', 'par_course_categories.created_by', '=', 'users.id')
                ->select('par_course_categories.*', 'users.name as author')
                ->where('par_course_categories.id', $id)
                ->first();

    if (!$course_category) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($course_category->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.CoursesModule.coursecategories.show', compact('course_category', 'duration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.CoursesModule.coursecategories.create');
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_course_categories', // Add the unique rule here
            'course_category_image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the maximum file size as needed
            'description' => 'required|string|max:1000',
        ]);

        // Get the image file from the request
        $image = $request->file('course_category_image_path');

        // Check if an image was uploaded
        if ($image) {
            // Define the folder path where the image will be stored
            $folderPath = 'public/course_category';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Insert the image path into the database
            DB::table('par_course_categories')->insert([
                'name' => $request->name,
                'course_category_image_path' => $folderPath . '/' . $imageName,
                'description' => $request->description,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            return $this->returnMessage('Course Category record created successfully', 'success');
        }

        // Handle the case where no image was uploaded
        return $this->returnMessage('No course category was uploaded', 'error');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $course_categories = DB::table('par_course_categories')->find($id);

        // Check if the blog exists
        if (!$course_categories) {
            abort(404);
        }

        return view('dashbord.CoursesModule.coursecategories.edit', compact('course_categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_course_categories,name,' . $id, // Add unique rule for updating
            'description' => 'required|string|max:1000',
            'course_category_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image to be nullable for updating
        ]);

        $course_category = DB::table('par_course_categories')->find($id);

        if (!$course_category) {
            abort(404);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        // Check if a new image was uploaded
        if ($request->hasFile('course_category_image_path')) {
            // Get the image file from the request
            $image = $request->file('course_category_image_path');

            // Define the folder path where the image will be stored
            $folderPath = 'public/course_category';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Set the new image path in the data array
            $data['course_category_image_path'] = $folderPath . '/' . $imageName;
        }

        // Update the course$course_category record
        DB::table('par_course_categories')
            ->where('id', $id)
            ->update($data);

        return $this->returnMessage('Course category record updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_course_categories')->where('id', $id)->delete();

    return $this->returnMessage('Course category record deleted successfully', 'success');
    }
}
