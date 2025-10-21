@extends('layouts.app')

@section('content')
<section class="fc-section">
  <div class="fc-container">
    <h2 data-aos="fade-up">{{ $service->name }}</h2>

    {{-- عرض الوسائط: صورة أو فيديو من Cloudinary --}}
    @if($service->image)
      @php
        $url = $service->image;
        $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
      @endphp

      <div style="margin:15px 0;" data-aos="zoom-in" data-aos-delay="100">
        @if(in_array($ext, ['mp4','webm','ogg']))
          <video controls style="max-width:400px; border-radius:8px;">
            <source src="{{ $url }}" type="video/{{ $ext }}">
            متصفحك لا يدعم تشغيل الفيديو
          </video>
        @else
          <img src="{{ $url }}" alt="{{ $service->name }}" style="max-width:400px; border-radius:8px;">
        @endif
      </div>
    @else
      <div style="margin:15px 0;" data-aos="zoom-in" data-aos-delay="100">
        <img src="{{ asset('assets/img/placeholder-service.png') }}" alt="لا توجد وسائط" style="max-width:400px; border-radius:8px;">
      </div>
    @endif

    <p data-aos="fade-up" data-aos-delay="150">{{ $service->description }}</p>
    <p class="price" data-aos="fade-up" data-aos-delay="200">
      السعر الابتدائي: <strong>{{ $service->price }}$</strong>
    </p>

    <h3 data-aos="fade-up" data-aos-delay="250">اطلب هذه الخدمة</h3>

    @auth
      @if(auth()->user()->role === 'client')
        <form class="fc-form" method="post" action="{{ route('client.orders.store') }}" data-aos="fade-up" data-aos-delay="300">
          @csrf
          <input type="hidden" name="service_id" value="{{ $service->id }}">

          <div class="fc-field" data-aos="fade-up" data-aos-delay="350">
            <label>وصف المشروع</label>
            <textarea name="description" rows="4" required></textarea>
          </div>

          <button type="submit" class="fc-btn-primary" data-aos="zoom-in" data-aos-delay="400">إرسال الطلب</button>
        </form>
      @else
        <p class="fc-alert error" data-aos="fade-up" data-aos-delay="300">
          فقط العملاء يمكنهم إرسال طلبات. الرجاء تسجيل الدخول كعميل.
        </p>
      @endif
    @else
      <p class="fc-alert error" data-aos="fade-up" data-aos-delay="300">
        الرجاء تسجيل الدخول كعميل لإرسال طلب.
      </p>
    @endauth

  </div>
</section>
@endsection
