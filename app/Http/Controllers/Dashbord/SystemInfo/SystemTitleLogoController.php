<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class SystemTitleLogoController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $social_media = DB::table('par_social_media')
        ->join('par_icons', 'par_social_media.icons_id', '=', 'par_icons.id')
        ->select('par_social_media.*', 'par_icons.icon as icons',  'par_social_media.created_at', 'par_social_media.updated_at')
        ->get();
 
        return view('dashbord.SystemInfo.AllPagesInfo.SystemSocialMedia.index', compact('social_media'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $media = DB::table('par_social_media')
        ->join('par_icons', 'par_social_media.icons_id', '=', 'par_icons.id')
        ->join('users', 'par_social_media.created_by', '=', 'users.id')
        ->select('par_social_media.*', 'par_icons.icon as icons',  'users.name as author', 'par_social_media.created_at', 'par_social_media.updated_at')
        ->where('par_social_media.id', $id)
        ->first();

    if (!$media) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($media->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.SystemInfo.AllPagesInfo.SystemSocialMedia.show', compact('media', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashbord.SystemInfo.AllPagesInfo.SystemSocialMedia.create');
        $icons = DB::table('par_icons')->get();
        return view('dashbord.SystemInfo.AllPagesInfo.SystemSocialMedia.create', compact('icons'));
    }

    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255|unique:par_social_media',
        'link' => 'required',
        'icons_id' => 'required',
    ]);

    DB::table('par_social_media')->insert([
        'name' => $request->name,
        'link' => $request->link,
        'icons_id' => $request->icons_id,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Social Media record created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $social_media = DB::table('par_social_media')->find($id);

        // Check if the blog exists
        if (!$social_media) {
            abort(404);
        }

        // Retrieve all icons associated with the blog
        $icons = DB::table('par_icons')->where('id', $social_media->icons_id)->get();

        return view('dashbord.SystemInfo.AllPagesInfo.SystemSocialMedia.edit', compact('social_media',  'icons'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_social_media,name,' . $id, 
            'link' => 'required',
            'icons_id' => 'required',
        ]);

        $social_media = DB::table('par_social_media')->find($id);

        if (!$social_media) {
            abort(404);
        }

        DB::table('par_social_media')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'link' => $request->link,
                'icons_id' => $request->icons_id,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Social Media record updated successfully', 'success');
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


