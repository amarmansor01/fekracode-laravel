@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>إضافة مستخدم جديد</h2>

  <form method="POST" action="{{ route('users.store') }}" class="fc-form">
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
      <label>كلمة المرور</label>
      <input type="password" name="password" required />
    </div>

    <div class="fc-field">
      <label>الدور</label>
      <select name="role" required>
        <option value="employee">موظف</option>
        <option value="client">عميل</option>
      </select>
    </div>

    <button type="submit" class="fc-btn-primary">إنشاء</button>
  </form>
</div>
@endsection
