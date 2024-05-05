<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library for time
use App\Models\User; // for count
use Illuminate\Support\Facades\Storage; // for file system image storage uploads

class SystemTestimonialsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $testimonials = DB::table('par_student_testimonials')->latest()->get();

         // Convert BLOB data to base64 encoded strings
         foreach ($testimonials as $testimonial) {
            $testimonial->image = 'data:image/jpeg;base64,' . base64_encode($testimonial->student_image_path);
        }
 
        return view('dashbord.SystemInfo.ServicePage.SystemTestimonials.index', compact('testimonials'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
   {
    $testimonial = DB::table('par_student_testimonials')
        ->join('users', 'par_student_testimonials.created_by', '=', 'users.id')
        ->select('par_student_testimonials.*', 'users.name as author', 'par_student_testimonials.created_at', 'par_student_testimonials.updated_at')
        ->where('par_student_testimonials.id', $id)
        ->first();

    if (!$testimonial) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($testimonial->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")


    return view('dashbord.SystemInfo.ServicePage.SystemTestimonials.show', compact('testimonial', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.SystemInfo.ServicePage.SystemTestimonials.create');
        // $icons = DB::table('par_icons')->get();
        // return view('dashbord.SystemInfo.ServicePage.SystemTestimonials.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required|string|max:255',
            'student_image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the maximum file size as needed
            'student_course' => 'required|string|max:255',
            'testmonial_message' => 'required|string|max:255',
        ]);

        // Get the image file from the request
        $image = $request->file('student_image_path');

        // Check if an image was uploaded
        if ($image) {
            // Define the folder path where the image will be stored
            $folderPath = 'public/student_testimonials';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Insert the image path into the database
            DB::table('par_student_testimonials')->insert([
                'student_course' => $request->student_course,
                'student_image_path' => $folderPath . '/' . $imageName,
                'student_name' => $request->student_name,
                'testmonial_message' => $request->testmonial_message,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            return $this->returnMessage('Testimonials record created successfully', 'success');
        }

        // Handle the case where no image was uploaded
        return $this->returnMessage('No Student testimonial was uploaded', 'error');
    }

    



    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $testimonials = DB::table('par_student_testimonials')->find($id);

        // Check if the blog exists
        if (!$testimonials) {
            abort(404);
        }

        return view('dashbord.SystemInfo.ServicePage.SystemTestimonials.edit', compact('testimonials'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_course' => 'required|string|max:255',
            'student_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image to be nullable for updating
            'student_name' => 'required|string|max:255|unique:par_student_testimonials,student_name,' . $id, // Add unique rule for updating
            'testmonial_message' => 'required|string|max:255',
        ]);

        $testimonial = DB::table('par_student_testimonials')->find($id);

        if (!$testimonial) {
            abort(404);
        }

        $data = [
            'student_course' => $request->student_course,
            'student_name' => $request->student_name,
            'testmonial_message' => $request->testmonial_message,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        // Check if a new image was uploaded
        if ($request->hasFile('student_image_path')) {
            // Get the image file from the request
            $image = $request->file('student_image_path');

            // Define the folder path where the image will be stored
            $folderPath = 'public/student_testimonials';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Set the new image path in the data array
            $data['student_image_path'] = $folderPath . '/' . $imageName;
        }

        // Update the testimonial record
        DB::table('par_student_testimonials')
            ->where('id', $id)
            ->update($data);

        return $this->returnMessage('Testimonials record updated successfully', 'success');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_student_testimonials')->where('id', $id)->delete();

    return $this->returnMessage('Testimonials record deleted successfully', 'success');
    }

}


