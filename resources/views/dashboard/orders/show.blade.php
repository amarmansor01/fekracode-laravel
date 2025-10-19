@extends('layouts.app')

@section('content')
<h2>تفاصيل الطلب رقم {{ $order->id }}</h2>

<ul>
    <li><strong>اسم العميل:</strong> {{ $order->client->name ?? 'غير محدد' }}</li>
    <li><strong>البريد الإلكتروني للعميل:</strong> {{ $order->client->email ?? 'غير متوفر' }}</li>

    @if($order->product)
        <li><strong>المنتج:</strong> {{ $order->product->name }}</li>
    @elseif($order->service)
        <li><strong>الخدمة:</strong> {{ $order->service->name }}</li>
    @else
        <li><strong>الخدمة/المنتج:</strong> غير محدد</li>
    @endif

    <li><strong>الوصف:</strong> {{ $order->description ?? 'لا يوجد وصف' }}</li>
    <li><strong>السعر:</strong> {{ number_format($order->price, 2) }} ل.س</li>
    <li><strong>تاريخ التسليم:</strong> {{ $order->delivery_date }}</li>
    <li><strong>الحالة:</strong> {{ $order->status }}</li>
    <li><strong>تاريخ الإنشاء:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</li>
</ul>
@endsection
