@extends('layouts.app')

@section('content')
<section class="fc-section">
  <div class="fc-container">
    <h2>الخدمات / المشاريع السابقة</h2>
    <div class="fc-grid">
      @foreach($products as $product)
        <div class="fc-card">
          @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
          @endif
          <h3>{{ $product->name }}</h3>
          <p>{{ Str::limit($product->description, 100) }}</p>
          <a href="{{ route('products.show', $product->id) }}" class="fc-btn-primary">عرض التفاصيل</a>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
