@extends('layouts.app')

@section('content')
<section class="fc-section">
  <div class="fc-container">
    <h2 data-aos="fade-up">{{ $service->name }}</h2>
    @php
      use Illuminate\Support\Facades\Storage;
      // جرب الحقل media أولاً ثم image كاحتياط
      $filename = $service->media ?? $service->image ?? null;
      $filename = $filename ? ltrim($filename, '/') : null;
      $diskPath = $filename ? 'services/' . $filename : null;

      // Force URL using APP_URL (config('app.url')) to match server host/port
      $appUrl = rtrim(config('app.url') ?? env('APP_URL') ?? '', '/');
      $forcedUrl = $filename ? ($appUrl . '/storage/services/' . $filename) : null;
    @endphp

    @if($filename)
      @if($diskPath && Storage::disk('public')->exists($diskPath))
        <img src="{{ $forcedUrl }}" alt="{{ $service->name }}" style="max-width:400px; border-radius:8px;" data-aos="zoom-in" data-aos-delay="100">
      @elseif(file_exists(public_path('storage/services/' . $filename)))
        <img src="{{ $forcedUrl }}" alt="{{ $service->name }}" style="max-width:400px; border-radius:8px;" data-aos="zoom-in" data-aos-delay="100">
      @else
        <img src="{{ asset('assets/img/placeholder-service.png') }}" alt="لا توجد صورة" style="max-width:400px; border-radius:8px;" data-aos="zoom-in" data-aos-delay="100">
      @endif
    @endif

    <p data-aos="fade-up" data-aos-delay="150">{{ $service->description }}</p>
    <p class="price" data-aos="fade-up" data-aos-delay="200">السعر الابتدائي: <strong>{{ $service->price }}$</strong></p>

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
        <p class="fc-alert error" data-aos="fade-up" data-aos-delay="300">فقط العملاء يمكنهم إرسال طلبات. الرجاء تسجيل الدخول كعميل.</p>
      @endif
    @else
      <p class="fc-alert error" data-aos="fade-up" data-aos-delay="300">الرجاء تسجيل الدخول كعميل لإرسال طلب.</p>
    @endauth

  </div>
</section>
@endsection
