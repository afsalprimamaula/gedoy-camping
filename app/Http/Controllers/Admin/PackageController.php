<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CampingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    public function index()
    {
        $packages = CampingPackage::latest()->get();
        return view('admin.packages', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        // Parse features from comma-separated string
        $features = [];
        if ($request->filled('features_raw')) {
            $features = array_map('trim', explode(',', $request->features_raw));
            $features = array_filter($features);
            $features = array_values($features);
        }

        // Auto-generate slug
        $slug = \Illuminate\Support\Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (CampingPackage::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
        }

        CampingPackage::create([
            'name'        => $request->name,
            'slug'        => $slug,
            'price'       => $request->price,
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'features'    => $features,
            'icon'        => $request->icon ?? '⛺',
            'is_active'   => $request->is_active ?? 1,
            'image_path'  => $imagePath,
        ]);

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Paket "' . $request->name . '" berhasil ditambahkan! ⛺');
    }

    public function update(Request $request, CampingPackage $package)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'capacity'    => 'required|integer|min:1',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $features = [];
        if ($request->filled('features_raw')) {
            $features = array_map('trim', explode(',', $request->features_raw));
            $features = array_filter($features);
            $features = array_values($features);
        }

        $imagePath = $package->image_path;
        if ($request->hasFile('image')) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('packages', 'public');
        }

        $package->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'capacity'    => $request->capacity,
            'description' => $request->description,
            'features'    => $features,
            'icon'        => $request->icon ?? $package->icon,
            'is_active'   => $request->is_active ?? $package->is_active,
            'image_path'  => $imagePath,
        ]);

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Paket "' . $package->name . '" berhasil diperbarui! ✅');
    }

    public function destroy(CampingPackage $package)
    {
        $name = $package->name;
        if ($package->image_path && Storage::disk('public')->exists($package->image_path)) {
            Storage::disk('public')->delete($package->image_path);
        }
        $package->delete();
        return redirect()->route('admin.packages.index')
                         ->with('success', 'Paket "' . $name . '" berhasil dihapus 🗑️');
    }
}
