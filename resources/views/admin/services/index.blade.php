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
            @if($service->media)
              @if(Str::endsWith($service->media, '.mp4'))
                <video width="100" controls src="{{ asset('storage/' . $service->media) }}"></video>
              @else
                <img width="100" src="{{ asset('storage/' . $service->media) }}" />
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
