<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Response;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use Response;

    public function index()
    {
        $notifications = auth()->user()->notifications;
        $notificationMessages = [];
        foreach ($notifications as $notification) {
            $notificationMessages[] = $notification->data['message'];
        }

        return $this->successResponse(data: $notificationMessages);
    }
}
