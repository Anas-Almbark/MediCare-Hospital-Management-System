<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = DB::table('notifications')
            ->where('receiver', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = DB::table('notifications')
            ->where('id', $id)
            ->where('receiver', auth()->id())
            ->update(['status' => 'read']);

        return response()->json(['success' => true]);
    }

    public function getUnreadCount()
    {
        return DB::table('notifications')
            ->where('receiver', auth()->id())
            ->where('status', '!=', 'read')
            ->count();
    }
}