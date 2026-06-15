<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantMenu;
use Illuminate\Http\Request;

class AdminRestaurantController extends Controller
{
    public function index()
    {
        $menus = RestaurantMenu::orderBy('category')->orderBy('name')->get();
        return view('admin.restaurant-menu', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:Makanan Utama,Dessert,Minuman',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string|in:tersedia,habis',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $imagePath = $filename;
        }

        RestaurantMenu::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.restaurant.index')->with('success', 'Menu baru berhasil ditambahkan! 🍳');
    }

    public function update(Request $request, $id)
    {
        $menu = RestaurantMenu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|in:Makanan Utama,Dessert,Minuman',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string|in:tersedia,habis',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imagePath = $menu->image_path;
        if ($request->hasFile('image')) {
            if ($menu->image_path && file_exists(public_path('img/' . $menu->image_path))) {
                @unlink(public_path('img/' . $menu->image_path));
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $imagePath = $filename;
        }

        $menu->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image_path' => $imagePath
        ]);

        return redirect()->route('admin.restaurant.index')->with('success', 'Menu hidangan berhasil diperbarui! 📝');
    }

    public function toggleStatus($id)
    {
        $menu = RestaurantMenu::findOrFail($id);
        $newStatus = $menu->status === 'tersedia' ? 'habis' : 'tersedia';
        $menu->update(['status' => $newStatus]);

        $emoji = $newStatus === 'tersedia' ? '🟢' : '🔴';
        return redirect()->route('admin.restaurant.index')->with('success', 'Status ' . $menu->name . ' diubah menjadi ' . $newStatus . ' ' . $emoji);
    }

    public function destroy($id)
    {
        $menu = RestaurantMenu::findOrFail($id);
        
        if ($menu->image_path && file_exists(public_path('img/' . $menu->image_path))) {
            @unlink(public_path('img/' . $menu->image_path));
        }

        $menu->delete();

        return redirect()->route('admin.restaurant.index')->with('success', 'Menu hidangan berhasil dihapus permanen! 🗑️');
    }
}
