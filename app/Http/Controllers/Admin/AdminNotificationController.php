<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use App\Models\StudentApply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminNotificationController extends Controller
{
     public function getApplicationFromNotification(Request $request, $notificationId)
    {
        // ১. লগড ইন admin
        $admin = Auth::guard('admin_token')->user();
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not authenticated.'
            ], 401);
        }

        // ২. Notification খুঁজো
        $notification = $admin->notifications()->find($notificationId);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.'
            ], 404);
        }

        // ৩. Notification থেকে data বের করা
        $data = $notification->data;
        $applicationId = $data['application_id'] ?? null;
        $type = $data['type'] ?? null;

        if (!$applicationId || !$type) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid notification data.'
            ], 400);
        }

        // ৪. Type অনুযায়ী application fetch করা
        if ($type === 'agent') {
            $application = Application::find($applicationId);
        } elseif ($type === 'student') {
            $application = StudentApply::find($applicationId);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Unknown application type.'
            ], 400);
        }

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => 'Application not found.'
            ], 404);
        }

        // ৫. Optional: Notification read mark করা
        $notification->markAsRead();

        // ৬. Response পাঠানো
        return response()->json([
            'success' => true,
            'type' => $type,
            'data' => $application
        ]);
    }

    public function index(Request $request)
    {
        $admin = Auth::guard('admin_token')->user();

        // Frontend থেকে পাঠানো removed notification IDs
        $removedIds = $request->input('removed_ids', []);

        $notifications = $admin->notifications()
            ->whereNotIn('id', $removedIds) // removed ones ফিল্টার
            ->latest()
            ->paginate(10);

        $data = $notifications->map(function ($notification) {

            $type = $notification->data['type'] ?? null;
            $applicationId = $notification->data['application_id'] ?? null;

            $application = null;
            if ($type === 'agent') {
                $application = Application::find($applicationId);
            } elseif ($type === 'student') {
                $application = StudentApply::find($applicationId);
            }

            return [
                'id' => $notification->id,
                'type' => $type,
                'is_read' => $notification->read_at ? true : false,
                'title' => $notification->data['title'] ?? 'No Title',
                'message' => $notification->data['message'] ?? '',
                'status' => $notification->data['status'] ?? null,
                'created_at' => $notification->created_at,
                'application' => $application,
            ];
        });

        return response()->json([
            'success' => true,
            'notifications' => $data,
            'pagination' => [
                'current_page' => $notifications->currentPage(),
                'last_page' => $notifications->lastPage(),
                'total' => $notifications->total(),
            ]
        ]);
    }


        public function unread()
    {
        $admin = Auth::guard('admin_token')->user();

        return response()->json([
            'success' => true,
            'count' => $admin->unreadNotifications->count(),
            'data' => $admin->unreadNotifications
        ]);
    }

      public function markAsRead($id)
    {
        $admin = Auth::guard('admin_token')->user();
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not authenticated.'
            ], 401);
        }

        $notification = $admin->notifications()->find($id);

        if (!$notification) {
            return response()->json([
                'success' => false,
                'message' => 'Notification not found.'
            ], 404);
        }

        // Mark as read
        $notification->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'Notification marked as read.',
            'notification' => [
                'id' => $notification->id,
                'is_read' => true,
                'read_at' => $notification->read_at,
            ]
        ]);
    }

    //  * Mark all notifications as read
    
    public function markAllAsRead()
    {
        $admin = Auth::guard('admin_token')->user();
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Admin not authenticated.'
            ], 401);
        }

        // Mark all unread notifications as read
        $admin->unreadNotifications->markAsRead();

        return response()->json([
            'success' => true,
            'message' => 'All notifications marked as read.',
            'unread_count' => 0
        ]);
    }

    // NotificationController.php
    public function latest()
    {
        // return "OK";
        $admin = Auth::guard('admin_token')->user();

        // শুধুমাত্র unread বা recent notification fetch
        $notifications = $admin->notifications()
            ->whereNull('read_at')
            ->latest()
            ->get();

        $data = $notifications->map(function ($notification) {
            $type = $notification->data['type'] ?? null;
            $applicationId = $notification->data['application_id'] ?? null;

            $application = null;
            if ($type === 'agent') {
                $application = Application::find($applicationId);
            } elseif ($type === 'student') {
                $application = StudentApply::find($applicationId);
            }

            return [
                'id' => $notification->id,
                'type' => $type,
                'is_read' => $notification->read_at ? true : false,
                'title' => $notification->data['title'] ?? 'No Title',
                'message' => $notification->data['message'] ?? '',
                'created_at' => $notification->created_at,
                'application' => $application,
            ];
        });

        return response()->json([
            'success' => true,
            'notifications' => $data,
        ]);
    }

    
}
