<?php

namespace App\Jobs;

use App\Mail\NotificationMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Notification;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
        // Get notifications where date has passed and excecuted_at is null
        $notifications = Notification::whereNull('excecuted_at')
            ->where('date', '<=', now())
            ->get();

        foreach ($notifications as $notification) {
            // Get the owner's email from the users table
            $owner = User::find($notification->owner_id);

            // Send email to the owner's email address
            if ($owner && $owner->email) {
                Mail::to($owner->email)->send(new NotificationMail($notification->title, $notification->content));

                // Update excecuted_at column
                $notifications = Notification::where('id', $notification->id)
                    ->update(['excecuted_at' => now()]);

                    $notifications = Notification::where('id', $notification->id)
                    ->update(['status_id' => '3']);
            }
        }
    } catch (\Exception $e) {
        // Log the error
        Log::error('Error sending notifications: ' . $e->getMessage());
    }
    }
}
