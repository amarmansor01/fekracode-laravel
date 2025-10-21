<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
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
            // رفع الملف إلى Cloudinary (صور أو فيديو)
            $upload = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                ['folder' => 'products']
            );
            $validated['image'] = $upload->getSecurePath();
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
            $upload = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                ['folder' => 'products']
            );
            $validated['image'] = $upload->getSecurePath();
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
