<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class ContactController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $blogs = DB::table('par_contact')->latest()->get();

        $contact = DB::table('par_contact')->get();

       // socia media
       $footer = DB::table('par_social_media')
       ->join('par_icons', 'par_social_media.icons_id', '=', 'par_icons.id')
       ->select('par_social_media.*', 'par_icons.icon as footer_media_icon')
       ->get();

       $topnavbar = DB::table('par_social_media')
       ->join('par_icons', 'par_social_media.icons_id', '=', 'par_icons.id')
       ->select('par_social_media.*', 'par_icons.icon as topbar_media_icon')
       ->get();
        // contact information

        $contact_info = DB::table('par_contact_info')
        ->join('par_icons', 'par_contact_info.phone_icon_id', '=', 'par_icons.id')
        ->select('par_contact_info.*', 'par_icons.icon as phone_icon')
        // ->latest('par_contact_info.created_at') // Specify the table for the created_at column
        ->limit(1)
        ->get();

        $address_info = DB::table('par_address_info')
        ->join('par_icons', 'par_address_info.address_icon_id', '=', 'par_icons.id')
        ->select('par_address_info.*', 'par_icons.icon as address_icon')
        // ->latest('par_address_info.created_at') // Specify the table for the created_at column
        ->limit(1)
        ->get();

        $email_info = DB::table('par_email_info')
        ->join('par_icons', 'par_email_info.email_icon_id', '=', 'par_icons.id')
        ->select('par_email_info.*', 'par_icons.icon as email_icon')
        // ->latest('par_email_info.created_at') // Specify the table for the created_at column
        ->limit(1)
        ->get();

        
        return view('publics.pages.contact', compact(
            'contact',
            'footer',
            'topnavbar',
            'contact_info', 
            'email_info', 
            'address_info'
        ));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = DB::table('par_contact')
                ->join('users', 'par_contact.created_by', '=', 'users.id')
                ->join('par_tags', 'par_contact.tags_id', '=', 'par_tags.id')
                ->join('par_blog_categories', 'par_contact.blog_categories_id', '=', 'par_blog_categories.id')
                ->select('par_contact.*', 'users.name as author', 'par_contact.created_at', 'par_contact.updated_at', 'par_tags.name as tag_name', 'par_blog_categories.name as category_name')
                ->where('par_contact.id', $id)
                ->first();

    if (!$blog) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($blog->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.BlogModule.Blogs.show', compact('blog', 'duration'));
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_contact')->where('id', $id)->delete();

    return $this->returnMessage('Contact record deleted successfully', 'success');
    }
}


