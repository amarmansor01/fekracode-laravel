@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>📦 جميع الطلبات</h2>

  @if(session('success'))
    <div class="fc-alert success">{{ session('success') }}</div>
  @endif

  <table class="fc-table">
    <thead>
      <tr>
        <th>الخدمة</th>
        <th>العميل</th>
        <th>الحالة</th>
        <th>ملاحظات</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->service->name ?? '—' }}</td>
          <td>{{ $order->client->name ?? '—' }}</td>
          <td>{{ $order->status }}</td>
          <td>{{ Str::limit($order->notes, 50) }}</td>
          <td>
            <a href="{{ route('employee.orders.edit', $order->id) }}">تعديل</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
