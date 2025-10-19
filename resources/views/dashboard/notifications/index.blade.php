@extends('layouts.app')

@section('content')
<h2>الإشعارات</h2>

@php
    $role = Auth::user()->role;
@endphp

<ul>
@forelse(auth()->user()->notifications as $notification)
    <li @if(is_null($notification->read_at)) style="font-weight:bold;" @endif>
        <a href="{{ $notification->data['action_url'] }}">
            {{ $notification->data['title'] }} - {{ $notification->data['message'] }}
        </a>
        <form method="POST" action="{{ $role === 'admin' 
            ? route('admin.notifications.read', $notification->id) 
            : route('employee.notifications.read', $notification->id) }}">
            @csrf
            <button type="submit">تعليم كمقروء</button>
        </form>
    </li>
@empty
    <li>لا توجد إشعارات حالياً.</li>
@endforelse
</ul>
@endsection
