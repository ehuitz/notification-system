<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class RequestController extends Controller
{

    // index --> show user's notifications /requests
    public function index() {
        return view('requests.index');
    }
    // show --> show a notification /requests/{id}

    public function show(Notification $notification) {
        return view('requests.show', [
            'notification' => $notification
        ]);
    }

    // create --> create notification page /request
    public function create() {

            return view('requests.create', [
        ]);
    }

    // store --> store notification /request
    public function store(Request $request) {
        $request->validate([
            'subject' => 'required',
            'content' => 'required',
            'date' => 'required',
            'time' => 'required'
        ]);

        $combined = date('Y-m-d H:i:s', strtotime("$request->date $request->time"));

        $status = Status::where('id', 1)->first();

        $notification = Notification::create([
            'title' => $request->subject,
            'content' => $request->content,
            'date' => $combined,
            'status_id' => $status->id,
            'owner_id' => auth()->user()->id,
        ]);

        return redirect()->route('requests.index');
    }
}
