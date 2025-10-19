<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'FekraCode' }}</title>
  
  <!-- فافيكون -->
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/img/favicon.svg') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <!-- خطوط -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- CSS & JS عبر Vite -->
  @vite(['resources/sass/app.scss', 'resources/js/app.js'])

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>
<body>
  <!-- الهيدر -->
  <header class="fc-header" data-aos="fade-down">
    <div class="fc-container">
      <a class="fc-logo" href="{{ url('/') }}">
        <img src="{{ asset('assets/img/logo.png') }}" alt="FekraCode Logo" style="width: 48px; height: 48px;" />
        <span>FekraCode</span>
      </a>

      <button class="fc-hamburger" id="hamburgerBtn" aria-label="Toggle Menu">
       ☰
      </button>

      <nav class="fc-nav">
        <ul>
          <li><a href="{{ url('/') }}#home">الرئيسية</a></li>
          <li><a href="{{ url('/') }}#services">الخدمات</a></li>
          <li><a href="{{ url('/') }}#projects">المشاريع السابقة</a></li>
          <li><a href="{{ url('/') }}#contact">تواصل</a></li>

          @auth
          <!-- 🔔 جرس الإشعارات -->
          <li class="fc-notifications">
            <a href="#" class="notification-bell">
              🔔
              @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="badge">
                  {{ auth()->user()->unreadNotifications->count() }}
                </span>
              @endif
            </a>
            <ul class="notifications-dropdown">
              @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                <li>
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
              @empty
                <li><span>لا يوجد إشعارات جديدة</span></li>
              @endforelse
              <li><a href="{{ route('notifications.index') }}">عرض كل الإشعارات</a></li>
            </ul>
          </li>
          @endauth
        </ul>
      </nav>
    </div>
  </header>

  <!-- محتوى الصفحة -->
  <main>
    @yield('content')
  </main>

<!-- الفوتر -->
<footer class="fc-footer" data-aos="fade-up">
  <div class="fc-container fc-footer-grid">
    
    <!-- قسم من نحن -->
    <div class="fc-footer-about">
      <h4>من نحن</h4>
      <p>
        نحن فريق FekraCode، نبتكر حلولًا تقنية عملية في تطوير المواقع والتطبيقات ونماذج الذكاء الاصطناعي. ندمج بين الهندسة والابتكار لنقدّم نتائج ملموسة تخدم السوق المحلي والعالمي.
      </p>
      <a href="{{ route('about') }}" class="fc-btn-secondary" style="padding:8px 12px; font-weight:600;">اقرأ المزيد</a>
    </div>

    <!-- الحقوق والسوشال -->
    <div class="fc-footer-meta">
      <p>© 2025 FekraCode — جميع الحقوق محفوظة</p>

      <div class="fc-social">
        <!-- Facebook -->
        <a href="https://facebook.com/amar.mansor.243033" target="_blank" aria-label="Facebook" title="Facebook" class="fc-social-link facebook">
          <!-- SVG -->
        </a>

        <!-- Instagram -->
        <a href="https://instagram.com/amarmansor5" target="_blank" aria-label="Instagram" title="Instagram" class="fc-social-link instagram">
          <!-- SVG -->
        </a>

        <!-- LinkedIn -->
        <a href="https://linkedin.com/in/your_profile" target="_blank" aria-label="LinkedIn" title="LinkedIn" class="fc-social-link linkedin">
          <!-- SVG -->
        </a>
      </div>
    </div>

  </div>
</footer>



  <!-- زر واتساب عائم -->
  <a href="https://wa.me/963942384671" class="whatsapp-float" target="_blank" aria-label="WhatsApp">💬</a>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

  <!-- AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 700,
      easing: 'ease-out-cubic'
    });
  </script>

  <!-- تفعيل السلايدر -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      if (document.querySelector('.fc-swiper')) {
        new Swiper('.fc-swiper', {
          loop: true,
          autoplay: { delay: 3000 },
          pagination: { el: '.swiper-pagination', clickable: true },
          slidesPerView: 1,
          breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
          }
        });
      }
    });
  </script>

  <!-- زر واتساب CSS -->
  <style>
    .whatsapp-float {
      position: fixed;
      bottom: 20px;
      left: 20px;
      background: #25D366;
      color: white;
      font-size: 24px;
      padding: 12px 14px;
      border-radius: 50%;
      box-shadow: 0 2px 6px rgba(0,0,0,0.3);
      z-index: 999;
      text-decoration: none;
    }
    .whatsapp-float:hover {
      background: #1DA851;
    }
  </style>
</body>
</html>
