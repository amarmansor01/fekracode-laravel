@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>✏️ تعديل حالة الطلب</h2>

  <form method="POST" action="{{ route('employee.orders.update', $order->id) }}" class="fc-form">
    @csrf @method('PUT')

    <div class="fc-field">
      <label>الحالة</label>
      <select name="status" required>
        <option value="قيد التنفيذ" {{ $order->status == 'قيد التنفيذ' ? 'selected' : '' }}>قيد التنفيذ</option>
        <option value="مكتمل" {{ $order->status == 'مكتمل' ? 'selected' : '' }}>مكتمل</option>
        <option value="ملغى" {{ $order->status == 'ملغى' ? 'selected' : '' }}>ملغى</option>
      </select>
    </div>

    <div class="fc-field">
      <label>ملاحظات</label>
      <textarea name="notes">{{ old('notes', $order->notes) }}</textarea>
    </div>

    <button type="submit" class="fc-btn-primary">حفظ التعديلات</button>
  </form>
</div>
@endsection
