@extends('layouts.app')

@section('content')
<section class="fc-section">
  <div class="fc-container" style="text-align:center;">
    <h2>لوحة الزبون</h2>
    <p>أهلاً {{ $user->name }}</p>

    <div style="margin-top:30px;">
      <a href="{{ route('client.orders.index') }}" class="fc-btn-primary" style="margin:10px;">
        📋 عرض طلباتي
      </a>

      <a href="{{ route('home') }}" class="fc-btn-secondary" style="margin:10px;">
        🏠 العودة للصفحة الرئيسية
      </a>
    </div>
  </div>
</section>
@endsection
