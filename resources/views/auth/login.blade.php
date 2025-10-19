@extends('layouts.app')

@section('content')
<section class="fc-auth-section">
  <div class="fc-container fc-auth-box">
    <h2>تسجيل الدخول</h2>

    @if(session('error'))
      <div class="fc-alert danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="fc-form">
      @csrf

      <div class="fc-field">
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" required autofocus />
      </div>

      <div class="fc-field">
        <label>كلمة المرور</label>
        <input type="password" name="password" required />
      </div>

      <button type="submit" class="fc-btn-primary">دخول</button>
    </form>

    <p style="margin-top: 10px;">ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب جديد</a></p>
  </div>
</section>
@endsection
