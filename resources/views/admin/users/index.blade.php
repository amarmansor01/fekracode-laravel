@extends('layouts.app')

@section('content')
<div class="fc-container">
  <h2>إدارة المستخدمين</h2>
  <a href="{{ route('users.create') }}" class="fc-btn-primary">إضافة موظف / عميل</a>

  @if(session('success'))
    <div class="fc-alert success">{{ session('success') }}</div>
  @endif

  <h3>الموظفون</h3>
  <table class="fc-table">
    <thead><tr><th>الاسم</th><th>البريد</th><th>إجراءات</th></tr></thead>
    <tbody>
      @foreach($employees as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <a href="{{ route('users.edit', $user->id) }}">تعديل</a>
            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" onclick="return confirm('هل أنت متأكد؟')">حذف</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <h3>العملاء</h3>
  <table class="fc-table">
    <thead><tr><th>الاسم</th><th>البريد</th><th>إجراءات</th></tr></thead>
    <tbody>
      @foreach($clients as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>
            <a href="{{ route('users.edit', $user->id) }}">تعديل</a>
            <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline;">
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
