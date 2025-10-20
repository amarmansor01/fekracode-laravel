@extends('layouts.app')

@section('content')
<section class="fc-section">
  <div class="fc-container">
    <h2 data-aos="fade-up">{{ $product->name }}</h2>

    {{-- عرض الوسائط: صورة أو فيديو من Cloudinary --}}
    @if($product->image)
      @php
        $url = $product->image;
        $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
      @endphp
      @if(in_array($ext, ['mp4','webm','ogg']))
        <div style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; max-width:100%; border-radius:8px; margin-bottom:15px;" data-aos="zoom-in">
          <video controls style="position:absolute; top:0; left:0; width:100%; height:100%; border-radius:8px;">
            <source src="{{ $url }}">
            متصفحك لا يدعم تشغيل الفيديو
          </video>
        </div>
      @else
        <img src="{{ $url }}" 
             alt="{{ $product->name }}" 
             style="max-width:100%; height:auto; border-radius:8px; margin-bottom:15px;"
             data-aos="zoom-in" data-aos-delay="100">
      @endif
    @endif

    {{-- الوصف --}}
    <p style="margin-top:10px;" data-aos="fade-up" data-aos-delay="150">{{ $product->description }}</p>

    {{-- السعر --}}
    <h3 data-aos="fade-up" data-aos-delay="200">السعر</h3>
    <p data-aos="fade-up" data-aos-delay="250">{{ $product->price }} $</p>

    {{-- التقنيات --}}
    @if($product->technologies)
      <h3 data-aos="fade-up" data-aos-delay="300">التقنيات المستخدمة</h3>
      <ul data-aos="fade-up" data-aos-delay="350">
        @foreach($product->technologies as $tech)
          <li>{{ $tech }}</li>
        @endforeach
      </ul>
    @endif

    {{-- النتائج --}}
    @if($product->results)
      <h3 data-aos="fade-up" data-aos-delay="400">النتائج</h3>
      <p data-aos="fade-up" data-aos-delay="450">{{ $product->results }}</p>
    @endif

    {{-- زر طلب مشروع مشابه --}}
    <h3 data-aos="fade-up" data-aos-delay="500">اطلب مشروع مشابه</h3>
    @auth
      @if(auth()->user()->role === 'client')
        <form id="similar-order-form" method="post" action="{{ route('client.orders.store') }}" data-aos="fade-up" data-aos-delay="550">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <input type="hidden" name="description" value="أرغب بمشروع مشابه لـ {{ $product->name }}">

          <button type="submit" class="fc-btn-primary">اطلب مشروع مشابه</button>
        </form>
      @else
        <p class="fc-alert error" data-aos="fade-up" data-aos-delay="550">فقط العملاء يمكنهم إرسال طلبات. الرجاء تسجيل الدخول كعميل.</p>
      @endif
    @else
      <p class="fc-alert error" data-aos="fade-up" data-aos-delay="550">الرجاء تسجيل الدخول كعميل لإرسال طلب.</p>
    @endauth

  </div>
</section>
@endsection
