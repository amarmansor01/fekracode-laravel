@extends('layouts.app')

@section('content')
<section class="fc-section">
  <div class="fc-container">
    <h2>طلباتي</h2>

    @if($orders->isEmpty())
      <p>لا يوجد طلبات بعد.</p>
    @else
      <table class="fc-table">
        <thead>
          <tr>
            <th>#</th>
            <th>الخدمة / المشروع</th>
            <th>الوصف</th>
            <th>السعر</th>
            <th>الحالة</th>
            <th>تاريخ التسليم</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>
                @if($order->service)
                  خدمة: {{ $order->service->name }}
                @elseif($order->product)
                  مشروع: {{ $order->product->name }}
                @endif
              </td>
              <td>{{ $order->description }}</td>
              <td>{{ $order->price }}$</td>
              <td>{{ $order->status }}</td>
              <td>{{ $order->delivery_date }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  </div>
</section>
@endsection
