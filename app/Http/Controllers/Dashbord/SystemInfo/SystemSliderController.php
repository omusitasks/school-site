<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class SystemSliderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sliders = DB::table('par_slider')->latest()->get();
 
        return view('dashbord.SystemInfo.HomePage.SystemSlider.index', compact('sliders'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $slider = DB::table('par_slider')
        ->join('users', 'par_slider.created_by', '=', 'users.id')
        ->select('par_slider.*',  'users.name as author', 'par_slider.created_at', 'par_slider.updated_at')
        ->where('par_slider.id', $id)
        ->first();

    if (!$slider) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($slider->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.SystemInfo.HomePage.SystemSlider.show', compact('slider', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.SystemInfo.HomePage.SystemSlider.create');
        // $icons = DB::table('par_icons')->get();
        // return view('dashbord.SystemInfo.HomePage.SystemSlider.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the maximum file size as needed
            'subtitle' => 'required|string|max:255',
        ]);

        // Get the image file from the request
        $image = $request->file('image_path');

        // Check if an image was uploaded
        if ($image) {
            // Define the folder path where the image will be stored
            $folderPath = 'public/system_slider';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Insert the image path into the database
            DB::table('par_slider')->insert([
                'title' => $request->title,
                'image_path' => $folderPath . '/' . $imageName,
                'subtitle' => $request->subtitle,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            return $this->returnMessage('Slider record created successfully', 'success');
        }

        // Handle the case where no image was uploaded
        return $this->returnMessage('No system slider was uploaded', 'error');
    }



    

    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $sliders = DB::table('par_slider')->find($id);

        // Check if the blog exists
        if (!$sliders) {
            abort(404);
        }

        return view('dashbord.SystemInfo.HomePage.SystemSlider.edit', compact('sliders'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image to be nullable for updating
            'title' => 'required|string|max:255|unique:par_slider,title,' . $id, // Add unique rule for updating
        ]);

        $sliders = DB::table('par_slider')->find($id);

        if (!$sliders) {
            abort(404);
        }

        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'image_path' => $request->image_path,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        // Check if a new image was uploaded
        if ($request->hasFile('image_path')) {
            // Get the image file from the request
            $image = $request->file('image_path');

            // Define the folder path where the image will be stored
            $folderPath = 'public/par_slider';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Set the new image path in the data array
            $data['image_path'] = $folderPath . '/' . $imageName;
        }

        // Update the testimonial record
        DB::table('par_slider')
            ->where('id', $id)
            ->update($data);

        return $this->returnMessage('Slider record updated successfully', 'success');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_slider')->where('id', $id)->delete();

    return $this->returnMessage('Slider record deleted successfully', 'success');
    }

}


