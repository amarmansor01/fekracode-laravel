@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>تعديل الطلب</h2>

  <form method="POST" action="{{ route('orders.update', $order->id) }}" class="fc-form">
    @csrf @method('PUT')

    <div class="fc-field">
      <label>الحالة</label>
      <select name="status" required>
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
        <option value="in_progress" {{ $order->status == 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تم التسليم</option>
      </select>
    </div>

    <div class="fc-field">
      <label>السعر</label>
      <input type="number" step="0.01" name="price" value="{{ old('price', $order->price) }}" />
    </div>

    <div class="fc-field">
      <label>تاريخ التسليم</label>
      <input type="date" name="delivery_date" value="{{ old('delivery_date', $order->delivery_date) }}" />
    </div>

    <div class="fc-field">
      <label>ملاحظات</label>
      <textarea name="notes">{{ old('notes', $order->notes) }}</textarea>
    </div>

    <button type="submit" class="fc-btn-primary">حفظ التعديلات</button>
  </form>
</div>
@endsection
