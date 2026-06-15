<?php

namespace App\Http\Controllers;

use App\Models\RestaurantMenu;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = RestaurantMenu::query()->where('status', 'tersedia');

        $activeCategory = $request->query('category', 'Semua');
        if ($activeCategory !== 'Semua') {
            $query->where('category', $activeCategory);
        }

        $menus = $query->orderBy('name')->get();

        return view('restaurant.index', compact('menus', 'activeCategory'));
    }
}
