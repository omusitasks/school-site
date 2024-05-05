<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class ContactInfoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $contact_information = DB::table('par_contact_info')->latest()->get();
 
        return view('dashbord.SystemInfo.AllPagesInfo.SystemContactInfo.index', compact('contact_information'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact_infor = DB::table('par_contact_info')
        ->join('par_icons', 'par_contact_info.phone_icon_id', '=', 'par_icons.id')
        ->join('users', 'par_contact_info.created_by', '=', 'users.id')
        ->select('par_contact_info.*','par_icons.icon as phone_icon' ,  'users.name as author', 'par_contact_info.created_at', 'par_contact_info.updated_at')
        ->where('par_contact_info.id', $id)
        ->first();

    if (!$contact_infor) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($contact_infor->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.SystemInfo.AllPagesInfo.SystemContactInfo.show', compact('contact_infor', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashbord.SystemInfo.AllPagesInfo.SystemContactInfo.create');
        $icons = DB::table('par_icons')->get();
        return view('dashbord.SystemInfo.AllPagesInfo.SystemContactInfo.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'company_phone_number' => 'required|string|max:255|unique:par_contact_info',
        'phone_icon_id' => 'required',
    ]);

    DB::table('par_contact_info')->insert([
        'company_phone_number' => $request->company_phone_number,
        'phone_icon_id' => $request->phone_icon_id,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Contact Information record created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $contact_information = DB::table('par_contact_info')->find($id);

        // Check if the blog exists
        if (!$contact_information) {
            abort(404);
        }

        // Retrieve all icons associated with the blog
        $icons = DB::table('par_icons')->where('id', $contact_information->phone_icon_id)->get();

        return view('dashbord.SystemInfo.AllPagesInfo.SystemContactInfo.edit', compact('contact_information',  'icons'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_phone_number' => 'required|string|max:255|unique:par_contact_info,company_phone_number,' . $id,
             'phone_icon_id' => 'required',
        ]);

        $contact_information = DB::table('par_contact_info')->find($id);

        if (!$contact_information) {
            abort(404);
        }

        DB::table('par_contact_info')
            ->where('id', $id)
            ->update([
                'company_phone_number' => $request->company_phone_number,
                'phone_icon_id' => $request->phone_icon_id,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Contact Information record updated successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_contact_info')->where('id', $id)->delete();

    return $this->returnMessage('Contact Information record deleted successfully', 'success');
    }

}


