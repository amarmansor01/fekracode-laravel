@extends('layouts.app')

@section('content')
<section class="fc-auth-section">
  <div class="fc-container fc-auth-box">
    <h2>إنشاء حساب جديد</h2>

    <form method="POST" action="{{ route('register') }}" class="fc-form">
      @csrf

      <input type="hidden" name="role" value="client" />

      <div class="fc-field">
        <label>الاسم الكامل</label>
        <input type="text" name="name" required />
      </div>

      <div class="fc-field">
        <label>البريد الإلكتروني</label>
        <input type="email" name="email" required />
      </div>

      <div class="fc-field">
        <label>كلمة المرور</label>
        <input type="password" name="password" required />
      </div>

      <div class="fc-field">
        <label>تأكيد كلمة المرور</label>
        <input type="password" name="password_confirmation" required />
      </div>

      <button type="submit" class="fc-btn-primary">إنشاء الحساب</button>
    </form>

    <p style="margin-top: 10px;">لديك حساب؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
  </div>
</section>
@endsection
