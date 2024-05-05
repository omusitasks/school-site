<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class SystemServicesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $services = DB::table('par_services_info')
        ->join('par_icons', 'par_services_info.service_icon_id', '=', 'par_icons.id')
        ->select('par_services_info.*', 'par_icons.icon as service_icon')
        ->latest('par_services_info.created_at') // Specify the table for the created_at column
        ->get();

 
        return view('dashbord.SystemInfo.ServicePage.SystemServices.index', compact('services'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = DB::table('par_services_info')
        ->join('par_icons', 'par_services_info.service_icon_id', '=', 'par_icons.id')
        ->join('users', 'par_services_info.created_by', '=', 'users.id')
        ->select('par_services_info.*', 'par_icons.icon as service_icon',  'users.name as author', 'par_services_info.created_at', 'par_services_info.updated_at')
        ->where('par_services_info.id', $id)
        ->first();

    if (!$service) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($service->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.SystemInfo.ServicePage.SystemServices.show', compact('service', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashbord.SystemInfo.ServicePage.SystemServices.create');
        $icons = DB::table('par_icons')->get();
        return view('dashbord.SystemInfo.ServicePage.SystemServices.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255|unique:par_services_info',
        'description' => 'string|max:255|unique:par_services_info',
        'service_icon_id' => 'required',
    ]);

    DB::table('par_services_info')->insert([
        'name' => $request->name,
        'description' => $request->description,
        'service_icon_id' => $request->service_icon_id,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Services record created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $services = DB::table('par_services_info')->find($id);

        // Check if the blog exists
        if (!$services) {
            abort(404);
        }

        // Retrieve all icons associated with the blog
        $icons = DB::table('par_icons')->where('id', $services->service_icon_id)->get();

        return view('dashbord.SystemInfo.ServicePage.SystemServices.edit', compact('services',  'icons'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_services_info,name,' . $id, 
            'service_icon_id' => 'required',
            'description' => 'string|max:255',
        ]);

        $services = DB::table('par_services_info')->find($id);

        if (!$services) {
            abort(404);
        }

        DB::table('par_services_info')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'service_icon_id' => $request->service_icon_id,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Services record updated successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_services_info')->where('id', $id)->delete();

    return $this->returnMessage('Services record deleted successfully', 'success');
    }

}


