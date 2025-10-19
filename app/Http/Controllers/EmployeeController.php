<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // صفحة لوحة التحكم للموظف
        return view('employee.dashboard');
    }
}
