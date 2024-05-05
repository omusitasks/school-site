<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class SystemPartnersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $partners = DB::table('par_partners_info')->latest()->get();
 
        return view('dashbord.SystemInfo.ServicePage.SystemPartners.index', compact('partners'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
   {
    $partner = DB::table('par_partners_info')
        ->join('users', 'par_partners_info.created_by', '=', 'users.id')
        ->select('par_partners_info.*', 'users.name as author', 'par_partners_info.created_at', 'par_partners_info.updated_at')
        ->where('par_partners_info.id', $id)
        ->first();

    if (!$partner) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($partner->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")


    return view('dashbord.SystemInfo.ServicePage.SystemPartners.show', compact('partner', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.SystemInfo.ServicePage.SystemPartners.create');
        // $icons = DB::table('par_icons')->get();
        // return view('dashbord.SystemInfo.ServicePage.SystemPartners.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'partner_logo_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the maximum file size as needed
            'description' => 'required|string|max:255',
        ]);

        // Get the image file from the request
        $image = $request->file('partner_logo_path');

        // Check if an image was uploaded
        if ($image) {
            // Define the folder path where the image will be stored
            $folderPath = 'public/system_partners';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Insert the image path into the database
            DB::table('par_partners_info')->insert([
                'name' => $request->name,
                'partner_logo_path' => $folderPath . '/' . $imageName,
                'description' => $request->description,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            return $this->returnMessage('Partners record created successfully', 'success');
        }

        // Handle the case where no image was uploaded
        return $this->returnMessage('No Partner Logo was uploaded', 'error');
    }



    

    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $partners = DB::table('par_partners_info')->find($id);

        // Check if the blog exists
        if (!$partners) {
            abort(404);
        }

        return view('dashbord.SystemInfo.ServicePage.SystemPartners.edit', compact('partners'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'partner_logo_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image to be nullable for updating
            'name' => 'required|string|max:255|unique:par_partners_info,name,' . $id, // Add unique rule for updating
            'description' => 'required|string|max:255',
        ]);

        $testimonial = DB::table('par_partners_info')->find($id);

        if (!$testimonial) {
            abort(404);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        // Check if a new image was uploaded
        if ($request->hasFile('partner_logo_path')) {
            // Get the image file from the request
            $image = $request->file('partner_logo_path');

            // Define the folder path where the image will be stored
            $folderPath = 'public/system_partners';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Set the new image path in the data array
            $data['partner_logo_path'] = $folderPath . '/' . $imageName;
        }

        // Update the testimonial record
        DB::table('par_partners_info')
            ->where('id', $id)
            ->update($data);

        return $this->returnMessage('Partners record updated successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_partners_info')->where('id', $id)->delete();

    return $this->returnMessage('Partners record deleted successfully', 'success');
    }

}


