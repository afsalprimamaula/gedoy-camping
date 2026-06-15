<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::latest()->get();
        return view('admin.gallery', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'   => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ], [
            'images.required'   => 'Pilih minimal satu file gambar.',
            'images.*.image'    => 'File harus berupa gambar.',
            'images.*.mimes'    => 'Format gambar harus JPG, PNG, WEBP, atau GIF.',
            'images.*.max'      => 'Ukuran file maksimal 5MB.',
        ]);

        $uploadedCount = 0;

        foreach ($request->file('images') as $file) {
            $path = $file->store('gallery', 'public');

            GalleryImage::create([
                'path'          => $path,
                'original_name' => $file->getClientOriginalName(),
                'size'          => $file->getSize(),
                'mime_type'     => $file->getMimeType(),
            ]);

            $uploadedCount++;
        }

        return redirect()->route('admin.gallery.index')
                         ->with('success', "{$uploadedCount} foto berhasil diupload ke galeri! 🖼️");
    }

    public function destroy(GalleryImage $image)
    {
        // Delete file from storage
        if (Storage::disk('public')->exists($image->path)) {
            Storage::disk('public')->delete($image->path);
        }

        $image->delete();

        return redirect()->route('admin.gallery.index')
                         ->with('success', 'Foto berhasil dihapus dari galeri 🗑️');
    }
}
