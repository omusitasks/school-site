<?php

namespace Modules\SystemBlog\app\Http\Controllers;

// use Modules\SystemBlog\app\Http\Controllers\BaseController as BaseController;
use Modules\SystemBlog\app\Http\Controllers\BaseController as BaseController;
// use App\Http\Controllers\Dashbord\BaseController as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library

class BlogController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $blogs = DB::table('par_blogs')->latest()->get();

        $blogs = DB::table('par_blogs')
        ->join('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
        ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
        ->join('users', 'par_blogs.created_by', '=', 'users.id')
        ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
        ->latest()
        ->get();

        return view('dashbord.BlogModule.Blogs.index', compact('blogs'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = DB::table('par_blogs')
                ->join('users', 'par_blogs.created_by', '=', 'users.id')
                ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
                ->join('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
                ->select('par_blogs.*', 'users.name as author', 'par_blogs.created_at', 'par_blogs.updated_at', 'par_tags.name as tag_name', 'par_blog_categories.name as category_name')
                ->where('par_blogs.id', $id)
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dashbord.BlogModule.Blogs.create');
        $tags = DB::table('par_tags')->get();
        $blog_categories = DB::table('par_blog_categories')->get();
        return view('dashbord.BlogModule.Blogs.create', compact('tags', 'blog_categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_blogs', // Add the unique rule here
            'description' => 'nullable|string|max:10000',
            'blog_image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'blog_categories_id' => 'required|integer',
            'tags_id' => 'required|integer',
        ]);

        // Get the image file from the request
        $image = $request->file('blog_image_path');

        // Check if an image was uploaded
        if ($image) {
            // Define the folder path where the image will be stored
            $folderPath = 'public/blogs';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Insert the image path into the database
            DB::table('par_blogs')->insert([
                'name' => $request->name,
                'blog_image_path' => $folderPath . '/' . $imageName,
                'description' => $request->description,
                'blog_categories_id' => $request->blog_categories_id,
                'tags_id' => $request->tags_id,
                'created_by' => auth()->id(),
                'created_at' => now(),
            ]);

            return $this->returnMessage('Blog record created successfully', 'success');
        }

        // Handle the case where no image was uploaded
        return $this->returnMessage('No blog image was uploaded', 'error');
    }


    /**
     * Show the form for editing the specified resource.
     */

     public function edit($id)
    {
        $blogs = DB::table('par_blogs')->find($id);

        // Check if the blog exists
        if (!$blogs) {
            abort(404);
        }

        $tags = DB::table('par_tags')->get();
        $blog_categories = DB::table('par_blog_categories')->get();

        // Retrieve all tags associated with the blog
        // $tags = DB::table('par_tags')->where('id', $blogs->tags_id)->get();

        // Retrieve all categories associated with the blog
        // $blog_categories = DB::table('par_blog_categories')->where('id', $blogs->blog_categories_id)->get();


        return view('dashbord.BlogModule.Blogs.edit', compact('blogs', 'blog_categories', 'tags'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:par_blogs,name,' . $id, // Add unique rule for updating
            'description' => 'required|string|max:1000',
            'blog_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image to be nullable for updating
            'blog_categories_id' => 'required|integer',
            'tags_id' => 'required|integer',
        ]);

        $blog = DB::table('par_blogs')->find($id);

        if (!$blog) {
            abort(404);
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'blog_categories_id' => $request->blog_categories_id,
            'tags_id' => $request->tags_id,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        // Check if a new image was uploaded
        if ($request->hasFile('blog_image_path')) {
            // Get the image file from the request
            $image = $request->file('blog_image_path');

            // Define the folder path where the image will be stored
            $folderPath = 'public/blogs';

            // Generate a unique file name for the image
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

            // Store the image in the specified folder with the unique file name
            $image->storeAs($folderPath, $imageName);

            // Set the new image path in the data array
            $data['blog_image_path'] = $folderPath . '/' . $imageName;
        }

        // Update the course$course_category record
        DB::table('par_blogs')
            ->where('id', $id)
            ->update($data);

        return $this->returnMessage('Blog record updated successfully', 'success');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_blogs')->where('id', $id)->delete();

    return $this->returnMessage('Blog record deleted successfully', 'success');
    }
}
