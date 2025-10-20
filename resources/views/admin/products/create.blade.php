@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>{{ isset($product) ? 'تعديل مشروع' : 'إضافة مشروع' }}</h2>

  <form method="POST" action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" enctype="multipart/form-data" class="fc-form">
    @csrf
    @if(isset($product)) @method('PUT') @endif

    <div class="fc-field">
      <label>العنوان</label>
      <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required />
    </div>

    <div class="fc-field">
      <label>الوصف</label>
      <textarea name="description" required>{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div class="fc-field">
      <label>صورة أو فيديو</label>
      <input type="file" name="image" />
      @if(isset($product) && $product->image)
        @php
          $url = $product->image;
          $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        @endphp
        @if(in_array($ext, ['mp4','webm','ogg']))
          <video width="200" controls src="{{ $url }}"></video>
        @else
          <img width="200" src="{{ $url }}" alt="{{ $product->name }}">
        @endif
      @endif
    </div>

    <button type="submit" class="fc-btn-primary">حفظ</button>
  </form>
</div>
@endsection
