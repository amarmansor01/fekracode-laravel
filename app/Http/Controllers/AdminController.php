<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // صفحة لوحة التحكم للمدير
        return view('admin.dashboard');
    }
}
