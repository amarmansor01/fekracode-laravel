<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

class ProductController extends Controller
{
    public function __construct()
    {
        // تهيئة Cloudinary مرة وحدة عند إنشاء الكنترولر
        Configuration::instance([
            'cloud' => [
                'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                'api_key'    => env('CLOUDINARY_API_KEY'),
                'api_secret' => env('CLOUDINARY_API_SECRET'),
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

    /**
     * عرض جميع المشاريع السابقة
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * عرض صفحة إنشاء مشروع جديد
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * تخزين مشروع جديد في قاعدة البيانات
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:20480',
        ]);

        if ($request->hasFile('image')) {
            try {
                $upload = (new UploadApi())->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'products',
                        'resource_type' => 'auto', // يدعم صور وفيديو
                    ]
                );
                $validated['image'] = $upload['secure_url'];
            } catch (\Exception $e) {
                \Log::error('Cloudinary Upload Error (store)', [
                    'message' => $e->getMessage(),
                    'trace'   => $e->getTraceAsString(),
                ]);
                dd($e->getMessage());
            }
        }

        Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'تمت إضافة المشروع بنجاح');
    }

    /**
     * عرض صفحة تعديل مشروع
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * تحديث بيانات مشروع موجود
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:20480',
        ]);

        if ($request->hasFile('image')) {
            try {
                $upload = (new UploadApi())->upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'products',
                        'resource_type' => 'auto',
                    ]
                );
                $validated['image'] = $upload['secure_url'];
            } catch (\Exception $e) {
                \Log::error('Cloudinary Upload Error (update)', [
                    'message' => $e->getMessage(),
                    'trace'   => $e->getTraceAsString(),
                ]);
                dd($e->getMessage());
            }
        }

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'تم تعديل المشروع بنجاح');
    }

    /**
     * حذف مشروع
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'تم حذف المشروع بنجاح');
    }
}
