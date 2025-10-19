@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>الطلبات</h2>

  @if(session('success'))
    <div class="fc-alert success">{{ session('success') }}</div>
  @endif

  <table class="fc-table">
    <thead>
      <tr>
        <th>الزبون</th>
        <th>الخدمة</th>
        <th>الحالة</th>
        <th>السعر</th>
        <th>التسليم</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
        <tr>
          <td>{{ $order->user->name }}</td>
          <td>{{ $order->service->name }}</td>
          <td>{{ $order->status }}</td>
          <td>{{ $order->price ?? '-' }}</td>
          <td>{{ $order->delivery_date ?? '-' }}</td>
          <td>
            <a href="{{ route('orders.edit', $order->id) }}">تعديل</a>
            <form method="POST" action="{{ route('orders.destroy', $order->id) }}" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
