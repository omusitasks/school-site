<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class EmailInfoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $email_information = DB::table('par_email_info')->latest()->get();
 
        return view('dashbord.SystemInfo.AllPagesInfo.SystemEmailInfo.index', compact('email_information'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $email_infor = DB::table('par_email_info')
        ->join('par_icons', 'par_email_info.email_icon_id', '=', 'par_icons.id')
        ->join('users', 'par_email_info.created_by', '=', 'users.id')
        ->select('par_email_info.*','par_icons.icon as email_icon' ,  'users.name as author', 'par_email_info.created_at', 'par_email_info.updated_at')
        ->where('par_email_info.id', $id)
        ->first();

    if (!$email_infor) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($email_infor->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.SystemInfo.AllPagesInfo.SystemEmailInfo.show', compact('email_infor', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashbord.SystemInfo.AllPagesInfo.SystemEmailInfo.create');
        $icons = DB::table('par_icons')->get();
        return view('dashbord.SystemInfo.AllPagesInfo.SystemEmailInfo.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'company_email' => 'required|string|max:255|unique:par_email_info',
        'email_icon_id' => 'required',
    ]);

    DB::table('par_email_info')->insert([
        'company_email' => $request->company_email,
        'email_icon_id' => $request->email_icon_id,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Email Information record created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $email_information = DB::table('par_email_info')->find($id);

        // Check if the blog exists
        if (!$email_information) {
            abort(404);
        }

        // Retrieve all icons associated with the blog
        $icons = DB::table('par_icons')->where('id', $email_information->email_icon_id)->get();

        return view('dashbord.SystemInfo.AllPagesInfo.SystemEmailInfo.edit', compact('email_information',  'icons'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'company_email' => 'required|string|max:255|unique:par_email_info,company_email,' . $id,
            'email_icon_id' => 'required',
        ]);

        $email_information = DB::table('par_email_info')->find($id);

        if (!$email_information) {
            abort(404);
        }

        DB::table('par_email_info')
            ->where('id', $id)
            ->update([
                'company_email' => $request->company_email,
                'email_icon_id' => $request->email_icon_id,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Email Information record updated successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_email_info')->where('id', $id)->delete();

    return $this->returnMessage('Email Information record deleted successfully', 'success');
    }

}


