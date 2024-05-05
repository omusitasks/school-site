<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class ContactMessagingController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $contactus = DB::table('par_contact')->latest()->get();
 
        return view('dashbord.SystemInfo.ContactPage.ContactMessaging.index', compact('contactus'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contact = DB::table('par_contact')
        ->join('users', 'par_contact.created_by', '=', 'users.id')
        ->select('par_contact.*', 'users.name as author', 'par_contact.created_at', 'par_contact.updated_at')
        ->where('par_contact.id', $id)
        ->first();

        if (!$contact) {
            abort(404); 
        }

        // Calculate the duration since the blog was created using Carbon
        $createdDate = Carbon::parse($contact->created_at);
        $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

        return view('dashbord.SystemInfo.ContactPage.ContactMessaging.show', compact('contact', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.SystemInfo.ContactPage.ContactMessaging.create');
        // $icons = DB::table('par_icons')->get();
        // return view('dashbord.SystemInfo.ContactPage.ContactMessaging.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255|unique:par_contact',
    ]);

    DB::table('par_contact')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Contact record created successfully', 'success');
    }


    

    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $contactus = DB::table('par_contact')->find($id);

        // Check if the blog exists
        if (!$contactus) {
            abort(404);
        }

        return view('dashbord.SystemInfo.ContactPage.ContactMessaging.edit', compact('contactus'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255|unique:par_contact,subject,' . $id,
        ]);

        $contactus = DB::table('par_contact')->find($id);

        if (!$contactus) {
            abort(404);
        }

        DB::table('par_contact')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
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
    DB::table('par_contact')->where('id', $id)->delete();

    return $this->returnMessage('Contact record deleted successfully', 'success');
    }

}


