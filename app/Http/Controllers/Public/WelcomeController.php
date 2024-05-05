<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // for count
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $welcome = null;
        // Fetch counts for different roles
        $tutorsCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'tutor');
        })->count();

        $studentCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'student');
        })->count();

        $clientCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();

        $adminCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();

        // fetch count for published blogs
        $publishedBlogsCount = DB::table('par_blogs')->count();

        // fetch count for projects
        $completedProjectsCount = DB::table('par_projects')
        ->where('name', 'Completed')->count();

        $inProgressProjectsCount = DB::table('par_projects')
        ->where('name', 'In Progress')->count();

        $declinedProjectsCount = DB::table('par_projects')
        ->where('name', 'Declined')->count();

        $rejectedProjectsCount = DB::table('par_projects')
        ->where('name', 'Rejected')->count();

        $acceptedProjectsCount = DB::table('par_projects')
        ->where('name', 'Accepted')->count();


        // Retrieve only 3 latest blogs
        $blogs = DB::table('par_blogs')
        ->join('par_blog_categories', 'par_blogs.blog_categories_id', '=', 'par_blog_categories.id')
        ->join('par_tags', 'par_blogs.tags_id', '=', 'par_tags.id')
        ->join('users', 'par_blogs.created_by', '=', 'users.id')
        ->select('par_blogs.*', 'par_blog_categories.name as category_name', 'par_tags.name as tag_name', 'users.name as author')
        ->latest()
        ->limit(3)
        ->get();

        $slider = DB::table('par_slider')->get();

        // // Convert BLOB data to base64 encoded strings
        // foreach ($slider as $slide) {
        //     $slide->image = 'data:image/jpeg;base64,' . base64_encode($slide->image);
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

        $services = DB::table('par_services_info')
        ->join('par_icons', 'par_services_info.service_icon_id', '=', 'par_icons.id')
        ->select('par_services_info.*', 'par_icons.icon as service_icon')
        ->get();

        $student_testimonials = DB::table('par_student_testimonials')->get();

        // // Convert BLOB data to base64 encoded strings
        // foreach ($student_testimonials as $testimonial) {
        //     $testimonial->student_image = 'data:image/jpeg;base64,' . base64_encode($testimonial->student_image);
        // }

        // partners
        $partners = DB::table('par_partners_info')->get();

        // // Convert BLOB data to base64 encoded strings
        // foreach ($partners as $partner) {
        //     $partner->partner_logo = 'data:image/jpeg;base64,' . base64_encode($partner->partner_logo);
        // }

        $courses = DB::table('par_courses')
        ->rightJoin('par_course_categories', 'par_courses.course_categories_id', '=', 'par_course_categories.id')
        // ->rightjoin('par_course_types', 'par_courses.course_types_id', '=', 'par_course_types.id')
        ->select(
            'par_courses.id',
            'par_courses.course_types_id',
            'par_courses.course_categories_id',
            'par_courses.name',
            'par_courses.description',
            'par_courses.code',
            'par_courses.is_enabled',
            // 'par_courses.students_enrolled',
            // 'par_courses.tutors_registered',
            'par_courses.subscription_fee',
            'par_courses.created_by',
            'par_courses.created_at',
            'par_courses.updated_by',
            'par_courses.updated_at',
            'par_courses.altered_by',
            'par_courses.altered_on',
            'par_course_categories.name as course_category_name',
            'par_course_categories.course_category_image_path as course_category_image_path',
            // 'par_course_types.name as course_type_name',
            DB::raw('COUNT(par_courses.id) as total_courses_per_category')
        )
        ->groupBy(
            'par_courses.id', 
            'par_courses.course_types_id', 
            'par_courses.course_categories_id', 
            'par_courses.name', 'par_courses.description', 
            'par_courses.code', 'par_courses.is_enabled', 
            // 'par_courses.students_enrolled', 
            // 'par_courses.tutors_registered', 
            'par_courses.subscription_fee', 
            'par_courses.created_by', 
            'par_courses.created_at', 
            'par_courses.updated_by', 
            'par_courses.updated_at', 
            'par_courses.altered_by', 
            'par_courses.altered_on', 
            'par_course_categories.name', 
            'par_course_categories.course_category_image_path',
            // 'par_course_types.name'
            )
        ->latest('par_courses.created_at')
        ->get();




        return view('publics.pages.welcome', compact( 'welcome',
            'tutorsCount', 'studentCount', 'clientCount', 'adminCount', 'publishedBlogsCount',
            'completedProjectsCount', 'inProgressProjectsCount', 'declinedProjectsCount', 'rejectedProjectsCount', 'acceptedProjectsCount',
            'blogs', 'slider', 'footer', 'topnavbar', 'contact_info', 
            'address_info', 'email_info', 'services', 'student_testimonials', 'partners', 'courses'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
