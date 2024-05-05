<?php

namespace Modules\SystemBlog\app\Http\Controllers;

use Modules\SystemBlog\app\Http\Controllers\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import the Carbon library

class BlogCategoriesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_categories = DB::table('par_blog_categories')->latest()->get();

        return view('dashbord.BlogModule.BlogCategory.index', compact('blog_categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog_categories = DB::table('par_blog_categories')
                ->join('users', 'par_blog_categories.created_by', '=', 'users.id')
                ->select('par_blog_categories.*', 'users.name as author')
                ->where('par_blog_categories.id', $id)
                ->first();

    if (!$blog_categories) {
        abort(404); 
    }

    // Calculate the duration since the blog category was created using Carbon
    $createdDate = Carbon::parse($blog_categories->created_at);
    $duration = $createdDate->diffForHumans(); // This will give the duration in human-readable format (e.g., "2 days ago", "3 months ago")

    return view('dashbord.BlogModule.BlogCategory.show', compact('blog_categories', 'duration'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashbord.BlogModule.BlogCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255|unique:par_blog_categories', // Add the unique rule here
        'description' => 'nullable|string',
    ]);

    DB::table('par_blog_categories')->insert([
        'name' => $request->name,
        'description' => $request->description,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Blog Category created successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $blog_categories = DB::table('par_blog_categories')->find($id);

        if (!$blog_categories) {
            abort(404);
        }

        return view('dashbord.BlogModule.BlogCategory.edit', compact('blog_categories'));
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

        $blog_categories = DB::table('par_blog_categories')->find($id);

        if (!$blog_categories) {
            abort(404);
        }

        DB::table('par_blog_categories')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ]);

        return $this->returnMessage('Blog Category updated successfully', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_blog_categories')->where('id', $id)->delete();

    return $this->returnMessage('Blog Category deleted successfully', 'success');
    }
}





