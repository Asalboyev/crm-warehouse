<?php

namespace App\Http\Controllers\Api\v1;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationController extends Controller
{
    // Get unread notifications
    public function getUnreadNotifications(Request $request)
    {
        $user = auth()->user();

        $notifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->where('created_at', '>', Carbon::now()->subDay())
            ->get();

        return response()->json($notifications);
    }

    // Get all notifications older than 1 day
    public function getAllNotifications(Request $request)
    {
        $user = auth()->user();

        $notifications = Notification::where('user_id', $user->id)
            ->where('created_at', '<=', Carbon::now()->subDay())
            ->get();

        return response()->json($notifications);
    }

    // Mark notification as read
    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
            return response()->json(['message' => 'Notification marked as read']);
        }
        return response()->json(['message' => 'Notification not found'], 404);
    }
}
