@extends('layouts.app')

@section('content')
<section class="fc-section">
  <div class="fc-container">
    <h2>الإشعارات</h2>
    <ul>
      @foreach($notifications as $notification)
        <li @if($notification->read_at==null) style="font-weight:bold;" @endif>
          <a href="{{ route('notifications.read', $notification->id) }}">
            @if(isset($notification->data['order_id']))
              طلب جديد من {{ $notification->data['name'] }}
            @elseif(isset($notification->data['product_id']))
              منتج جديد: {{ $notification->data['name'] }}
            @elseif(isset($notification->data['service_id']))
              خدمة جديدة: {{ $notification->data['name'] }}
            @endif
          </a>
        </li>
      @endforeach
    </ul>
  </div>
</section>
@endsection
