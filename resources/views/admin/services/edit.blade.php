@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>{{ isset($service) ? 'تعديل خدمة' : 'إضافة خدمة' }}</h2>

  <form method="POST" action="{{ isset($service) ? route('services.update', $service->id) : route('services.store') }}" enctype="multipart/form-data" class="fc-form">
    @csrf
    @if(isset($service)) @method('PUT') @endif

    <div class="fc-field">
      <label>الاسم</label>
      <input type="text" name="name" value="{{ old('name', $service->name ?? '') }}" required />
    </div>

    <div class="fc-field">
      <label>الوصف</label>
      <textarea name="description" required>{{ old('description', $service->description ?? '') }}</textarea>
    </div>

    <div class="fc-field">
      <label>السعر</label>
      <input type="number" step="0.01" name="price" value="{{ old('price', $service->price ?? '') }}" required />
    </div>

    <div class="fc-field">
      <label>صورة أو فيديو</label>
      <input type="file" name="image" />
    </div>

    <button type="submit" class="fc-btn-primary">حفظ</button>
  </form>
</div>
@endsection
