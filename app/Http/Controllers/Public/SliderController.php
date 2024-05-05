<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class SliderController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // $blogs = DB::table('par_slider')->latest()->get();

        $slider = DB::table('par_slider')->get();

        
        return view('publics.pages.slider', compact('slider'));
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $slider = DB::table('par_slider')
                ->join('users', 'par_slider.created_by', '=', 'users.id')
                ->join('par_tags', 'par_slider.tags_id', '=', 'par_tags.id')
                ->join('par_blog_categories', 'par_slider.blog_categories_id', '=', 'par_blog_categories.id')
                ->select('par_slider.*', 'users.name as author', 'par_slider.created_at', 'par_slider.updated_at', 'par_tags.name as tag_name', 'par_blog_categories.name as category_name')
                ->where('par_slider.id', $id)
                ->first();

    if (!$slider) {
        abort(404); 
    }

    return view('publics.pages.slider', compact('slider'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255|unique:par_slider',
    ]);

    DB::table('par_slider')->insert([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'created_by' => auth()->id(),
        'created_at' => now(),
    ]);

    return $this->returnMessage('Slider record created successfully', 'success');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    DB::table('par_slider')->where('id', $id)->delete();

    return $this->returnMessage('Slider record deleted successfully', 'success');
    }
}


