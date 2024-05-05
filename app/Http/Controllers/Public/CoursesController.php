<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class CoursesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
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

        // // Convert BLOB data to base64 encoded strings
        // foreach ($courses as $course) {
        //     $course->course_category_image_path = 'data:image/jpeg;base64,' . base64_encode($course->course_category_image_path);
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

        return view('publics.pages.courses', compact(
            'courses',
            'footer',
            'topnavbar', 
            'contact_info', 
            'email_info', 
            'address_info',
        ));
    }

}


