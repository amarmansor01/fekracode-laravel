@extends('layouts.app')

@section('content')
<section id="home" class="fc-hero" style="background: var(--gradient);">
  <div class="fc-container">
    <h1 data-aos="fade-up">حلول تقنية ذكية مع FekraCode</h1>
    <p data-aos="fade-up" data-aos-delay="100">نطوّر مواقع، تطبيقات، وحلول ذكاء اصطناعي مخصصة لاحتياجاتك.</p>
    <a href="#services" class="fc-btn-primary" data-aos="fade-up" data-aos-delay="200">شاهد خدماتنا</a>

    <div class="fc-auth-links" style="margin-top: 20px;" data-aos="fade-up" data-aos-delay="300">
      @guest
        <a href="{{ route('login') }}" class="fc-btn-secondary">تسجيل الدخول</a>
        <a href="{{ route('register') }}" class="fc-btn-secondary">إنشاء حساب</a>
      @endguest

      @auth
        <p>مرحبًا {{ auth()->user()->name }}!
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
        </p>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      @endauth
    </div>
  </div>

  <img src="{{ asset('assets/img/brain-logo.png') }}" alt="FekraCode Icon" class="hero-icon" />
</section>

@php
  use Illuminate\Support\Str;
  use Illuminate\Support\Facades\Storage;
@endphp

<section id="services" class="fc-section">
  <div class="fc-container">
    <h2 data-aos="fade-up">الخدمات</h2>
    <div class="swiper fc-swiper" data-aos="fade-up" data-aos-delay="100">
      <div class="swiper-wrapper">
        @foreach($services as $service)
          @php
            $stored = $service->media ?? $service->image ?? null;
            $path = $stored ? (Str::startsWith($stored, 'services/') ? $stored : 'services/' . ltrim($stored, '/')) : null;

            if ($path && Storage::disk('public')->exists($path)) {
              $imgUrl = Storage::disk('public')->url($path);
            } elseif ($stored && file_exists(public_path('storage/services/' . basename($stored)))) {
              $imgUrl = asset('storage/services/' . basename($stored));
            } else {
              $imgUrl = asset('assets/img/placeholder-service.png');
            }
          @endphp

          <div class="swiper-slide fc-card" data-aos="zoom-in" data-aos-delay="150">
            <div class="fc-card-media">
              <img src="{{ $imgUrl }}" alt="{{ $service->name }}" class="fc-thumb" />
            </div>

            <div class="fc-card-body">
              <h3>{{ $service->name }}</h3>
              <p>{{ Str::limit($service->description, 80) }}</p>
              <p><strong>{{ $service->price }}$</strong></p>
              <a href="{{ route('service', $service->id) }}" class="fc-btn-primary">تفاصيل الخدمة</a>
            </div>
          </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>

<section id="projects" class="fc-section alt">
  <div class="fc-container">
    <h2 data-aos="fade-up">المشاريع السابقة</h2>
    <div class="fc-grid">
      @foreach($products as $product)
        @php
          $file = $product->image ?? null;
          $relative = $file ? (Str::startsWith($file, 'products/') ? $file : 'products/' . ltrim($file, '/')) : null;
          $existsOnDisk = $relative ? Storage::disk('public')->exists($relative) : false;
          $mediaUrl = $existsOnDisk ? Storage::disk('public')->url($relative) : asset('assets/img/placeholder-service.png');
          $ext = $file ? strtolower(pathinfo($file, PATHINFO_EXTENSION)) : null;
          $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
          $isVideo = in_array($ext, ['mp4','webm','ogg']);
        @endphp

        <div class="fc-card project-card" data-aos="fade-up" data-aos-delay="100">
          <div class="project-media">
            @if($existsOnDisk && $isImage)
              <img src="{{ $mediaUrl }}" alt="{{ $product->name }}">
            @elseif($existsOnDisk && $isVideo)
              <video controls preload="metadata">
                <source src="{{ $mediaUrl }}" type="video/{{ $ext }}">
                متصفحك لا يدعم عرض الفيديو
              </video>
            @else
              <img src="{{ $mediaUrl }}" alt="لا توجد وسائط">
            @endif
          </div>

          <div class="project-body">
            <h3>{{ $product->name }}</h3>
            <p>{{ Str::limit($product->description, 100) }}</p>
            <a href="{{ route('product', $product->id) }}" class="fc-btn-primary">تفاصيل</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section id="contact" class="fc-section alt">
  <div class="fc-container">
    <h2 data-aos="fade-up">تواصل معنا</h2>

    @if(session('success'))
      <div class="fc-alert success" data-aos="fade-up" data-aos-delay="100">
        {{ session('success') }}
      </div>
    @endif

    <form class="fc-form" method="post" action="{{ route('contact.store') }}" data-aos="fade-up" data-aos-delay="150">
      @csrf
      <div class="fc-field">
        <label>الاسم</label>
        <input type="text" name="name" required />
      </div>
      <div class="fc-field">
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" required />
      </div>
      <div class="fc-field">
        <label>رسالتك</label>
        <textarea name="message" rows="4" required></textarea>
      </div>
      <button type="submit" class="fc-btn-secondary" id="submitBtn">
        <span class="btn-text">إرسال</span>
        <span class="btn-loader" style="display:none;">⏳</span>
      </button>
    </form>

    @if(session('success'))
      <script>
        alert("✅ تم إرسال رسالتك بنجاح! سنرد عليك قريبًا.");
      </script>
    @endif

    <div class="fc-social" style="margin-top: 20px;" data-aos="fade-up" data-aos-delay="200">
      <a href="https://wa.me/963942384671" target="_blank">واتساب</a>
      <a href="https://t.me/The1deceiver" target="_blank">تلغرام</a>
      <a href="https://instagram.com/amarmansor5" target="_blank">إنستغرام</a>
      <a href="https://facebook.com/amar.mansor.243033" target="_blank">فيسبوك</a>
    </div>
  </div>
</section>
@endsection
