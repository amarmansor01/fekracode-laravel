<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\OrderCreated;

class OrderController extends Controller
{
    // عرض كل الطلبات (لوحة المدير)
    public function index()
    {
        $orders = Order::with(['user', 'service'])->latest()->get();
        return view('orders.index', compact('orders'));
    }

    // عرض نموذج إضافة طلب (لوحة عامة أو لوحة الزبون)
    public function create()
    {
        $clients = User::where('role', 'client')->get();
        $services = Service::all();
        return view('orders.create', compact('clients', 'services'));
    }



    // حفظ الطلب من الزبون المسجل
public function storeFromClient(Request $request)
{
    $validated = $request->validate([
        'service_id'  => 'nullable|exists:services,id',
        'product_id'  => 'nullable|exists:products,id',
        'description' => 'nullable|string',
    ]);

    $user = auth()->user();

    // إذا طلب خدمة
    if ($request->filled('service_id')) {
        $service = Service::findOrFail($request->service_id);
        $validated['service_id'] = $service->id;
        $validated['product_id'] = null;
        $validated['price'] = $service->price;
    }
    // إذا طلب مشروع سابق
    elseif ($request->filled('product_id')) {
        $product = \App\Models\Product::findOrFail($request->product_id);
        $validated['product_id'] = $product->id;
        $validated['service_id'] = null;
        $validated['price'] = 0; // أو سعر المنتج إذا عندك عمود سعر
    } else {
        return redirect()->back()->withErrors('يجب اختيار خدمة أو مشروع.');
    }

    $validated['client_id'] = $user->id;
    $validated['name'] = $user->name;
    $validated['email'] = $user->email;
    $validated['delivery_date'] = now()->addDays(3);
    $validated['status'] = 'قيد المعالجة';

    $order = Order::create($validated);


    // إشعار للـ admin/employee
    $admins = \App\Models\User::whereIn('role', ['admin','employee'])->get();
    foreach ($admins as $admin) {
    $admin->notify(new \App\Notifications\NewOrderNotification($order));
    }
    return redirect()->route('client.dashboard')->with('success', 'تم إرسال الطلب بنجاح');
  }


    // عرض نموذج تعديل الطلب
    public function edit(Order $order)
    {
        $clients = User::where('role', 'client')->get();
        $services = Service::all();
        return view('orders.edit', compact('order', 'clients', 'services'));
    }

    // تحديث الطلب
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'service_id'    => 'required|exists:services,id',
            'description'   => 'nullable|string',
            'price'         => 'required|numeric',
            'delivery_date' => 'required|date',
            'status'        => 'required|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'تم تحديث الطلب بنجاح');
    }

    // حذف الطلب
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'تم حذف الطلب');
    }

    // عرض طلبات الزبون
    public function clientOrders()
   {
    $orders = Order::with(['service','product'])
        ->where('client_id', auth()->id())
        ->latest()
        ->get();

    return view('client.orders.index', compact('orders'));
   }


    // عرض تفاصيل الطلب حسب الدور
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $user = auth()->user();

        if ($user->role === 'admin') {
            return view('dashboard.orders.show', compact('order'));
        }

        if ($user->role === 'employee') {
            return view('dashboard.orders.show', compact('order'));
        }

        if ($user->id === $order->user_id) {
            return view('dashboard.orders.show', compact('order'));
        }

        abort(403, 'غير مصرح لك');
    }
}
