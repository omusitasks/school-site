<?php

namespace Modules\SystemBlog\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View; // Import View facade
use Carbon\Carbon; // Import the Carbon library


class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = DB::table('par_tags')->latest()->get();

        return view('dashbord.BlogModule.Tags.index', compact('tags'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tag = DB::table('par_tags')
                ->join('users', 'par_tags.created_by', '=', 'users.id')
                ->select('par_tags.*', 'users.name as author')
                ->where('par_tags.id', $id)
                ->first();

    if (!$tag) {
        abort(404); 
    }

    // Calculate the duration since the blog was created using Carbon
    $createdDate = Carbon::parse($tag->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.BlogModule.Tags.show', compact('tag', 'duration'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.BlogModule.Tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255|unique:par_tags', // Add the unique rule here
        'description' => 'nullable|string',
    ]);

    DB::table('par_tags')->insert([
        'name' => $request->name,
        'description' => $request->description,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Tag created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $tag = DB::table('par_tags')->find($id);

        if (!$tag) {
            abort(404);
        }

        return view('dashbord.BlogModule.Tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $tag = DB::table('par_tags')->find($id);

        if (!$tag) {
            abort(404);
        }

        DB::table('par_tags')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Tag updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_tags')->where('id', $id)->delete();

    return $this->returnMessage('Tag deleted successfully', 'success');
    }
}
