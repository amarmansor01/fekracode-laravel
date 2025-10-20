@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>الخدمات</h2>
  <a href="{{ route('services.create') }}" class="fc-btn-primary">إضافة خدمة</a>

  @if(session('success'))
    <div class="fc-alert success">{{ session('success') }}</div>
  @endif

  <table class="fc-table">
    <thead>
      <tr>
        <th>الاسم</th>
        <th>الوصف</th>
        <th>السعر</th>
        <th>الوسائط</th>
        <th>إجراءات</th>
      </tr>
    </thead>
    <tbody>
      @foreach($services as $service)
        <tr>
          <td>{{ $service->name }}</td>
          <td>{{ Str::limit($service->description, 50) }}</td>
          <td>{{ $service->price }}$</td>
          <td>
            @if($service->image)
              @php
                $url = $service->image;
                $ext = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
              @endphp
              @if(in_array($ext, ['mp4','webm','ogg']))
                <video width="100" controls src="{{ $url }}"></video>
              @else
                <img width="100" src="{{ $url }}" alt="{{ $service->name }}" />
              @endif
            @endif
          </td>
          <td>
            <a href="{{ route('services.edit', $service->id) }}">تعديل</a>
            <form method="POST" action="{{ route('services.destroy', $service->id) }}" style="display:inline;">
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
