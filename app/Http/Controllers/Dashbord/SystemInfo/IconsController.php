<?php

namespace App\Http\Controllers\Dashbord\SystemInfo;

use App\Http\Controllers\Dashbord\BaseController as BaseController;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon; // Import the Carbon library


class IconsController extends BaseController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $icons = DB::table('par_icons')->get();
        return view('dashbord.SystemInfo.AllPagesInfo.SystemIcons.index', compact('icons'));
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $icon = DB::table('par_icons')
        ->join('users', 'par_icons.created_by', '=', 'users.id')
        ->select('par_icons.*',  'users.name as author', 'par_icons.created_at', 'par_icons.updated_at')
        ->where('par_icons.id', $id)
        ->first();

    if (!$icon) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($icon->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.SystemInfo.AllPagesInfo.SystemIcons.show', compact('icon', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.SystemInfo.AllPagesInfo.SystemIcons.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'icon' => 'required|string|max:255',
    ]);

    DB::table('par_icons')->insert([
        'name' => $request->name,
        'icon' => $request->icon,
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
        $icons = DB::table('par_icons')->find($id);

        // Check if the blog exists
        if (!$icons) {
            abort(404);
        }

        return view('dashbord.SystemInfo.AllPagesInfo.SystemIcons.edit', compact('icons'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'icon' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:par_icons,name,' . $id,
        ]);

        $icons = DB::table('par_icons')->find($id);

        if (!$icons) {
            abort(404);
        }

        DB::table('par_icons')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'icon' => $request->icon,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Icon record updated successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_icons')->where('id', $id)->delete();

    return $this->returnMessage('Icon record deleted successfully', 'success');
    }

}
