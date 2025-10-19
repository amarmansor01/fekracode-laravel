{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('content')
<section class="fc-section alt">
  <div class="fc-container">
    <h2 data-aos="fade-up">من نحن</h2>
    <p data-aos="fade-up" data-aos-delay="100">
      نحن FekraCode، شركة تقنية ناشئة بقيادة فريق صغير شغوف. نعمل على تطوير مواقع وتطبيقات ونماذج ذكاء اصطناعي مخصصة، ونركز على تقديم حلول واقعية تخدم المجتمع المحلي والعالمي. نؤمن بأن الدمج بين الهندسة والابتكار هو مفتاح التميز.
    </p>
    <div data-aos="fade-up" data-aos-delay="150" style="margin-top:16px;">
      <a href="{{ url('/') }}#services" class="fc-btn-primary">شاهد خدماتنا</a>
      <a href="{{ url('/') }}#contact" class="fc-btn-secondary">تواصل معنا</a>
    </div>
  </div>
</section>
@endsection
