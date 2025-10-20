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
              @if(in_array($ext, ['mp4','webm','ogg']))
                <video width="100" controls src="{{ $url }}"></video>
              @else
                <img width="100" src="{{ $url }}" alt="{{ $product->name }}" />
              @endif
            @endif
          </td>
          <td>
            <a href="{{ route('admin.products.edit', $product->id) }}">تعديل</a>
            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
