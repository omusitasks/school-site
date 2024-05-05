<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class SocialMediaController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function indexTopNavBar()
    {
        $topnavbar = DB::table('par_social_media')->get();

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
        // ->latest('par_email_info.created_at') // Specify the table for the created_at 
        ->limit(1)
        ->get();

        return view('publics.pages.topbar', compact(
            'topnavbar', 
            'contact_info', 
            'email_info', 
            'address_info'
        ));
    }

    public function indexFooter()
    {
        $footer = DB::table('par_social_media')->get();

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
        // ->latest('par_email_info.created_at') // Specify the table for the created_at 
        ->limit(1)
        ->get();
        
        return view('publics.pages.footer', compact(
            'footer', 
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
        $blog = DB::table('par_social_media')
                ->join('users', 'par_social_media.created_by', '=', 'users.id')
                ->join('par_tags', 'par_social_media.tags_id', '=', 'par_tags.id')
                ->join('par_blog_categories', 'par_social_media.blog_categories_id', '=', 'par_blog_categories.id')
                ->select('par_social_media.*', 'users.name as author', 'par_social_media.created_at', 'par_social_media.updated_at', 'par_tags.name as tag_name', 'par_blog_categories.name as category_name')
                ->where('par_social_media.id', $id)
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
        'subject' => 'required|string|max:255|unique:par_social_media',
    ]);

    DB::table('par_social_media')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Social Media record created successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_social_media')->where('id', $id)->delete();

    return $this->returnMessage('Social Media record deleted successfully', 'success');
    }
}


