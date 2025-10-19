@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>لوحة تحكم الموظف</h2>
  <p>مرحبًا، يمكنك متابعة الطلبات وتنفيذ المهام هنا.</p>

  <div class="fc-grid">
    <div class="fc-card">
      <h3>📦 الطلبات</h3>
      <p>عرض وتحديث حالة الطلبات والملاحظات.</p>
      <a href="{{ route('employee.orders.index') }}" class="fc-btn-primary">متابعة الطلبات</a>
    </div>
  </div>
</div>
@endsection
