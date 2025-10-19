<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('notifications.index', compact('notifications'));
    }

    public function read($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        // التوجيه حسب نوع الإشعار
        if(isset($notification->data['order_id'])){
            return redirect()->route('orders.show', $notification->data['order_id']);
        }
        if(isset($notification->data['product_id'])){
            return redirect()->route('products.show', $notification->data['product_id']);
        }
        if(isset($notification->data['service_id'])){
            return redirect()->route('services.show', $notification->data['service_id']);
        }

        return redirect()->route('notifications.index');
    }
}


