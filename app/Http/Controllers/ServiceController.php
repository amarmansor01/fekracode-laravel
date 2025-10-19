<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * عرض الصفحة الرئيسية مع كل الخدمات
     */
    public function index()
   {
    $services = \App\Models\Service::all();
    $products = \App\Models\Product::all();

    return view('home.index', [
        'title' => 'FekraCode — حلول تقنية ذكية',
        'services' => $services,
        'products' => $products
    ]);
   }

    /**
     * عرض تفاصيل خدمة معينة
     */
    public function show($id)
    {
        // جلب الخدمة حسب الـ id أو إرجاع 404 إذا غير موجودة
        $service = Service::findOrFail($id);

        // تمريرها للواجهة services/show.blade.php
        return view('services', compact('service'));
    }
}
