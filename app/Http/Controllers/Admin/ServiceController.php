<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Cloudinary\Api\Upload\UploadApi; // استدعاء الكلاس الجديد

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:20480'
        ]);

        if ($request->hasFile('image')) {
            try {
                $upload = (new UploadApi())->upload(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'services']
                );
                $validated['image'] = $upload['secure_url'];
            } catch (\Exception $e) {
                \Log::error('Cloudinary Upload Error', [
                    'message' => $e->getMessage(),
                    'trace'   => $e->getTraceAsString(),
                ]);
                dd($e->getMessage());
            }
        }

        Service::create($validated);

        return redirect()->route('services.index')->with('success', 'تمت إضافة الخدمة بنجاح');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric',
            'image'       => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm,ogg|max:20480'
        ]);

        if ($request->hasFile('image')) {
            try {
                $upload = (new UploadApi())->upload(
                    $request->file('image')->getRealPath(),
                    ['folder' => 'services']
                );
                $validated['image'] = $upload['secure_url'];
            } catch (\Exception $e) {
                \Log::error('Cloudinary Upload Error', [
                    'message' => $e->getMessage(),
                    'trace'   => $e->getTraceAsString(),
                ]);
                dd($e->getMessage());
            }
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'تم تعديل الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'تم حذف الخدمة');
    }
}
