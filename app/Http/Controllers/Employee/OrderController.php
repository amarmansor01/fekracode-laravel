<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // عرض كل الطلبات
        $orders = Order::with(['service', 'client'])->latest()->get();
        return view('employee.orders.index', compact('orders'));
    }

    public function edit(Order $order)
    {
        // الموظف يقدر يعدل أي طلب
        return view('employee.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:قيد التنفيذ,مكتمل,ملغى',
            'notes'  => 'nullable|string|max:1000',
        ]);

        $order->update($validated);

        return redirect()->route('employee.orders.index')->with('success', 'تم تحديث الطلب بنجاح');
    }
}
