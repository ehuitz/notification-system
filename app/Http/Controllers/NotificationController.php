<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NotificationController extends Controller
{
    public function index() {

        return view('notifications.index');
    }

}

