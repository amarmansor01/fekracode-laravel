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
              @if(Str::endsWith($product->image, '.mp4'))
                <video width="100" controls src="{{ asset('storage/' . $product->image) }}"></video>
              @else
                <img width="100" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" />
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
