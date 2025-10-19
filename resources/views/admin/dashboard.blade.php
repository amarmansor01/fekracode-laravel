@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>لوحة تحكم المدير</h2>
  <p>اختر القسم الذي تريد إدارته:</p>

  <div class="fc-grid">
    <div class="fc-card">
      <h3>الخدمات</h3>
      <p>إضافة وتعديل وحذف الخدمات المعروضة.</p>
      <a href="{{ route('services.index') }}" class="fc-btn-primary">إدارة الخدمات</a>
    </div>

    <div class="fc-card">
      <h3>المستخدمون</h3>
      <p>عرض وتعديل وحذف الموظفين والعملاء، وإنشاء موظفين جدد.</p>
      <a href="{{ route('users.index') }}" class="fc-btn-primary">إدارة المستخدمين</a>
    </div>

    <div class="fc-card">
      <h3>الطلبات</h3>
      <p>متابعة الطلبات وتحديد السعر والتسليم.</p>
      <a href="{{ route('orders.index') }}" class="fc-btn-primary">إدارة الطلبات</a>
    </div>

    <div class="fc-card">
      <h3>المشاريع السابقة</h3>
      <p>إضافة وتعديل المشاريع المنجزة.</p>
      <a href="{{ route('admin.products.index') }}" class="fc-btn-primary">إدارة المشاريع</a>
    </div>

    <div class="fc-card">
      <h3>التقارير</h3>
      <p>عرض ملخص الطلبات والإيرادات والحالات.</p>
      <a href="{{ route('admin.reports') }}" class="fc-btn-primary">عرض التقارير</a>
    </div>
  </div>
</div>
@endsection
