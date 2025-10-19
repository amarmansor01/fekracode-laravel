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

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

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
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M22 12.06C22 6.51 17.52 2 12 2S2 6.51 2 12.06c0 4.99 3.66 9.13 8.44 9.94v-7.03H8.08v-2.91h2.36V9.86c0-2.33 1.38-3.62 3.5-3.62.99 0 2.03.18 2.03.18v2.24h-1.14c-1.12 0-1.47.7-1.47 1.41v1.69h2.5l-.4 2.91h-2.1v7.03C18.34 21.19 22 17.05 22 12.06z"/>
          </svg>
        </a>

        <!-- Instagram -->
        <a href="https://instagram.com/amarmansor5" target="_blank" aria-label="Instagram" title="Instagram" class="fc-social-link instagram">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M12 2.2c3.2 0 3.6 0 4.9.07 1.2.06 2 .25 2.46.42.62.24 1.06.52 1.52.98.46.46.74.9.98 1.52.17.46.36 1.26.42 2.46.07 1.3.07 1.7.07 4.9s0 3.6-.07 4.9c-.06 1.2-.25 2-.42 2.46-.24.62-.52 1.06-.98 1.52-.46.46-.9.74-1.52.98-.46.17-1.26.36-2.46.42-1.3.07-1.7.07-4.9.07s-3.6 0-4.9-.07c-1.2-.06-2-.25-2.46-.42-.62-.24-1.06-.52-1.52-.98a3.9 3.9 0 0 1-.98-1.52c-.17-.46-.36-1.26-.42-2.46C2.2 15.6 2.2 15.2 2.2 12s0-3.6.07-4.9c.06-1.2.25-2 .42-2.46.24-.62.52-1.06.98-1.52.46-.46.9-.74 1.52-.98.46-.17 1.26-.36 2.46-.42C8.4 2.2 8.8 2.2 12 2.2Zm0 2c-3.13 0-3.5 0-4.73.07-.98.05-1.52.21-1.87.35-.47.18-.8.39-1.15.74-.35.35-.56.68-.74 1.15-.14.35-.3.89-.35 1.87C3.1 10.5 3.1 10.87 3.1 14s0 3.5.07 4.73c.05.98.21 1.52.35 1.87.18.47.39.8.74 1.15.35.35.68.56 1.15.74.35.14.89.3 1.87.35 1.23.07 1.6.07 4.73.07s3.5 0 4.73-.07c.98-.05 1.52-.21 1.87-.35.47-.18.8-.39 1.15-.74.35-.35.56-.68.74-1.15.14-.35.3-.89.35-1.87.07-1.23.07-1.6.07-4.73s0-3.5-.07-4.73c-.05-.98-.21-1.52-.35-1.87-.18-.47-.39-.8-.74-1.15a3 3 0 0 0-1.15-.74c-.35-.14-.89-.3-1.87-.35C15.5 4.2 15.13 4.2 12 4.2Zm0 3.3a4.5 4.5 0 1 1 0 9 4.5 4.5 0 0 1 0-9Zm0 2a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Zm5.05-2.7a1.05 1.05 0 1 1 0 2.1 1.05 1.05 0 0 1 0-2.1Z"/>
          </svg>
        </a>

        <!-- LinkedIn -->
        <a href="https://linkedin.com/in/your_profile" target="_blank" aria-label="LinkedIn" title="LinkedIn" class="fc-social-link linkedin">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
            <path d="M4.98 3.5C4.98 4.88 3.86 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8.5h4V23h-4V8.5zm7.5 0h3.8v2h.06c.53-1 1.83-2.06 3.76-2.06 4.02 0 4.77 2.64 4.77 6.08V23h-4v-6.2c0-1.48-.03-3.38-2.06-3.38-2.06 0-2.38 1.6-2.38 3.27V23h-4V8.5z"/>
          </svg>
        </a>
      </div>
    </div>

  </div>
</footer>



  <!-- زر واتساب عائم -->
  <a href="https://wa.me/963942384671" class="whatsapp-float" target="_blank" aria-label="WhatsApp">💬</a>

  <!-- JS -->
  <script src="{{ asset('assets/js/script.js') }}"></script>

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
