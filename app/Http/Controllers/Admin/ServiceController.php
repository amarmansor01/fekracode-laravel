<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
            // رفع الملف إلى Cloudinary (صور أو فيديو)
            $upload = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                ['folder' => 'services']
            );
            $validated['image'] = $upload->getSecurePath();
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
            $upload = Cloudinary::uploadFile(
                $request->file('image')->getRealPath(),
                ['folder' => 'services']
            );
            $validated['image'] = $upload->getSecurePath();
        }

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'تم تعديل الخدمة');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'تم حذف الخدمة');
    }
}
