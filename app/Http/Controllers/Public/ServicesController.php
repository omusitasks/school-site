<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon; // Import the Carbon library
use App\Models\User; // for count

class ServicesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $services = DB::table('par_services_info')
        ->join('par_icons', 'par_services_info.service_icon_id', '=', 'par_icons.id')
        ->select('par_services_info.*', 'par_icons.icon as service_icon')
        ->get();

        $student_testimonials = DB::table('par_student_testimonials')->get();

        // Convert BLOB data to base64 encoded strings
        // foreach ($student_testimonials as $testimonial) {
        //     $testimonial->student_image = 'data:image/jpeg;base64,' . base64_encode($testimonial->student_image);
        // }

        // partners
        $partners = DB::table('par_partners_info')->get();

        // Convert BLOB data to base64 encoded strings
        // foreach ($partners as $partner) {
        //     $partner->partner_logo = 'data:image/jpeg;base64,' . base64_encode($partner->partner_logo);
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

        return view('publics.pages.services', compact(
            'services',
            'footer',
            'topnavbar', 
            'contact_info', 
            'email_info', 
            'address_info',
            'student_testimonials',
            'partners'
        ));
    }

}


