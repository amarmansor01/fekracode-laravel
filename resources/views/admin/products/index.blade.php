@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>المشاريع السابقة</h2>
  <a href="{{ route('admin.products.create') }}" class="fc-btn-primary">إضافة مشروع</a>

  @if(session('success'))
    <div class="fc-alert success">{{ session('success') }}</div>
  @endif

  <table class="fc-table">
    <thead>
      <tr>
        <th>العنوان</th>
        <th>الوصف</th>
        <th>الوسائط</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      @foreach($products as $product)
        <tr>
          <td>{{ $product->name }}</td>
          <td>{{ Str::limit($product->description, 50) }}</td>
          <td>
            @if($product->image)
              @php
                $url = $product->image;
                $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
              @endphp
              <div style="margin-top:5px;">
                @if(in_array($ext, ['mp4','webm','ogg']))
                  <video width="120" controls>
                    <source src="{{ $url }}" type="video/{{ $ext }}">
                    متصفحك لا يدعم تشغيل الفيديو
                  </video>
                @else
                  <img width="120" src="{{ $url }}" alt="{{ $product->name }}">
                @endif
              </div>
            @else
              <div style="margin-top:5px;">
                <img width="120" src="{{ asset('assets/img/placeholder-service.png') }}" alt="لا توجد وسائط">
              </div>
            @endif
          </td>
          <td>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="fc-btn-secondary">تعديل</a>
            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="fc-btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
