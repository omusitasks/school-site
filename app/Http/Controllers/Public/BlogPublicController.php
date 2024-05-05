<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library

class BlogPublicController extends BaseController
{
    /**
     * Display a listing of the resource. BLOG LIST VIEW
     */

    public function index()
    {
        // $blogs = DB::table('par_blogs')->latest()->get();

        // Retrieve all blogs
        $blogs = DB::table('par_blogs')
        ->leftJoin('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
        ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
        ->join('users', 'par_blogs.created_by', '=', 'users.id')
        ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
        ->latest()
        ->distinct()
        ->paginate(6); // 6 items per page

        // Retrieve only 3 latest blogs
        $latestBlogs = DB::table('par_blogs')
        ->leftJoin('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
        ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
        ->join('users', 'par_blogs.created_by', '=', 'users.id')
        ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
        ->latest()
        ->limit(3)
        ->get();

        $categories = DB::table('par_blog_categories')->get();
        $tags = DB::table('par_tags')->get();


        // Convert BLOB data to base64 encoded strings
        // foreach ($blogs as $blog) {
        //     $blog->image = 'data:image/jpeg;base64,' . base64_encode($blog->image);
        // }

        // foreach ($latestBlogs as $blog) {
        //     $blog->image = 'data:image/jpeg;base64,' . base64_encode($blog->image);
        // }

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

        return view('publics.pages.blog-list', compact(
            'blogs', 
            'latestBlogs', 
            'categories', 
            'tags',
            'footer',
            'topnavbar',
            'contact_info', 
            'email_info', 
            'address_info',
        ));
    }


    /**
     * Display a listing of the resource. CATEGORY BLOG LIST VIEW
     */

    //  public function indexCategoryTag($id)
    //  {
    //      // $blogs = DB::table('par_blogs')->latest()->get();
 
    //      $category_blog = DB::table('par_blogs')
    //      ->join('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
    //      ->where('par_blogs.id', $id)
    //      ->get();

    //      return view('publics.pages.blog-list', compact(
    //         'category_blog'
    //     ));
    // }


    /**
     * Display a listing of the resource. CATEGORY BLOG LIST VIEW
     */

     public function indexCategoryTagBlog($id)
     {
         // $blogs = DB::table('par_blogs')->latest()->get();
 
         // Retrieve all blogs
         $blogs = DB::table('par_blogs')
         ->leftJoin('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
         ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
         ->join('users', 'par_blogs.created_by', '=', 'users.id')
         ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
         ->latest()
         ->distinct()
         ->paginate(6); // 6 items per page
 
         // Retrieve only 3 latest blogs
         $latestBlogs = DB::table('par_blogs')
         ->leftJoin('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
         ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
         ->join('users', 'par_blogs.created_by', '=', 'users.id')
         ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
         ->latest()
         ->limit(3)
         ->get();
 
         $category_blog = DB::table('par_blogs')
         ->join('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
         ->where('par_blogs.id', $id)
         ->get();
 
         $tag_blog = DB::table('par_blogs')
         ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
         ->where('par_blogs.id', $id)
         ->get();
 
 
         // Convert BLOB data to base64 encoded strings
        //  foreach ($blogs as $blog) {
        //      $blog->image = 'data:image/jpeg;base64,' . base64_encode($blog->image);
        //  }
 
        //  foreach ($latestBlogs as $blog) {
        //      $blog->image = 'data:image/jpeg;base64,' . base64_encode($blog->image);
        //  }
 
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
 
         return view('publics.pages.blog-category', compact(
             'blogs', 
             'latestBlogs', 
             'categories', 
             'tags',
             'footer',
             'topnavbar',
             'contact_info', 
             'email_info', 
             'address_info',
             'category_blog',
             'tag_blog'
         ));
     }



    /**
     * Display the specified resource. BLOG DETAIL VIEW
     */
    public function show($id)
    {

        // Retrieve all blogs
        $blogs = DB::table('par_blogs')
        ->leftJoin('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
        ->leftJoin('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
        ->join('users', 'par_blogs.created_by', '=', 'users.id')
        ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
        ->latest()
        ->distinct()
        ->paginate(6); // 6 items per page


        // Retrieve only 3 latest blogs
        $latestBlogs = DB::table('par_blogs')
        ->leftJoin('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
        ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
        ->join('users', 'par_blogs.created_by', '=', 'users.id')
        ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
        ->latest()
        ->limit(3)
        ->distinct()
        ->get();

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

    // $categories = DB::table('par_blog_categories')->get();
    $categories = DB::table('par_blogs')
    ->join('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
    ->where('par_blogs.id', $id)
    ->get();

    // $tags = DB::table('par_tags')->get();
    $tags = DB::table('par_blogs')
    ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
    ->where('par_blogs.id', $id)
    ->get();

    // Convert BLOB data to base64 encoded strings
    // $blog->image = 'data:image/jpeg;base64,' . base64_encode($blog->image);

    // foreach ($latestBlogs as $blog) {
    //     $blog->image = 'data:image/jpeg;base64,' . base64_encode($blog->image);
    // }

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


    return view('publics.pages.blog-detail', compact(
        'blog', 
        'duration', 
        'blogs', 
        'latestBlogs', 
        'categories', 
        'tags',
        'footer',
        'topnavbar',
        'contact_info', 
        'email_info', 
        'address_info'
    ));
    }

   
}
