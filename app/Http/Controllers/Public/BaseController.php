<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function returnMessage($message, $type)
    {
        $notification = [
            'message' => $message,
            'alert-type' => $type,
        ];

        return redirect()->back()->with($notification);
    }
}
