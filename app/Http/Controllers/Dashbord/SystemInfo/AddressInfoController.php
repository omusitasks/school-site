<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class AddressInfoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $address_information = DB::table('par_address_info')->latest()->get();
 
        return view('dashbord.SystemInfo.AllPagesInfo.SystemAddressInfo.index', compact('address_information'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $address_infor = DB::table('par_address_info')
        ->join('par_icons', 'par_address_info.address_icon_id', '=', 'par_icons.id')
        ->join('users', 'par_address_info.created_by', '=', 'users.id')
        ->select('par_address_info.*','par_icons.icon as address_icon' ,  'users.name as author', 'par_address_info.created_at', 'par_address_info.updated_at')
        ->where('par_address_info.id', $id)
        ->first();

    if (!$address_infor) {
        abort(404); 
    }

     // Calculate the duration since the blog was created using Carbon
     $createdDate = Carbon::parse($address_infor->created_at);
     $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")
 

    return view('dashbord.SystemInfo.AllPagesInfo.SystemAddressInfo.show', compact('address_infor', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashbord.SystemInfo.AllPagesInfo.SystemAddressInfo.create');
        $icons = DB::table('par_icons')->get();
        return view('dashbord.SystemInfo.AllPagesInfo.SystemAddressInfo.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'street_address_name' => 'required|string|max:255|unique:par_address_info',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'address_icon_id' => 'required',
    ]);

    DB::table('par_address_info')->insert([
        'street_address_name' => $request->street_address_name,
        'city' => $request->city,
        'country' => $request->country,
        'address_icon_id' => $request->address_icon_id,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Address Information record created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $address_information = DB::table('par_address_info')->find($id);

        // Check if the blog exists
        if (!$address_information) {
            abort(404);
        }

        // Retrieve all icons associated with the blog
        $icons = DB::table('par_icons')->where('id', $address_information->address_icon_id)->get();

        return view('dashbord.SystemInfo.AllPagesInfo.SystemAddressInfo.edit', compact('address_information',  'icons'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'street_address_name' => 'required|string|max:255|unique:par_address_info,street_address_name,' . $id,
        // 'name' => 'required|string|max:255|unique:par_partners_info,name,' . $id, // Add unique rule for updating
        // 'city' => 'required|string|max:255',
        // 'country' => 'required|string|max:255',
        'address_icon_id' => 'required',
    ]);

    // Debugging: Dump request data to check if it contains the expected values
    // dd($request->all());

    $address_information = DB::table('par_address_info')->find($id);

    if (!$address_information) {
        abort(404);
    }

    DB::table('par_address_info')
        ->where('id', $id)
        ->update([
            'street_address_name' => $request->street_address_name,
            'city' => $request->city,
            'country' => $request->country,
            'address_icon_id' => $request->address_icon_id,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ]);

    return $this->returnMessage('Address Information record updated successfully', 'success');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_address_info')->where('id', $id)->delete();

    return $this->returnMessage('Address Information record deleted successfully', 'success');
    }

}


