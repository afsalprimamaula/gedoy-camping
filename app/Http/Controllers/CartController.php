<?php

namespace App\Http\Controllers;

use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = (int) ($subtotal * 0.11);
        $grandTotal = $subtotal + $tax;

        return view('restaurant.cart', compact('cart', 'subtotal', 'tax', 'grandTotal'));
    }

    public function add($id)
    {
        $menu = RestaurantMenu::findOrFail($id);
        
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $menu->name,
                'quantity' => 1,
                'price' => $menu->price,
                'category' => $menu->category,
                'image_path' => $menu->image_path
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $menu->name . ' berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'action' => 'required|in:increase,decrease'
        ]);

        $id = $request->id;
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action === 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]);
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $name = $cart[$id]['name'];
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->route('cart.index')->with('success', $name . ' berhasil dihapus dari keranjang.');
        }

        return redirect()->route('cart.index');
    }

    public function checkout(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan masuk (login) terlebih dahulu untuk melakukan pemesanan restoran.');
        }

        $request->validate([
            'tenda_number' => 'required|string|max:50',
            'delivery_time' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('restaurant.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $tax = (int) ($subtotal * 0.11);
        $grandTotal = $subtotal + $tax;

        // Save order
        $order = RestaurantOrder::create([
            'user_id' => Auth::id(),
            'tenda_number' => $request->tenda_number,
            'delivery_time' => $request->delivery_time,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'grand_total' => $grandTotal,
            'status' => 'pending',
        ]);

        // Save order items
        foreach ($cart as $id => $item) {
            RestaurantOrderItem::create([
                'restaurant_order_id' => $order->id,
                'restaurant_menu_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Clear cart session
        session()->forget('cart');

        return redirect()->route('user.dashboard', ['tab' => 'orders'])->with('success', 'Pesanan restoran Anda berhasil dikirim! Silakan tunggu di tenda, kami sedang menyiapkan hidangan lezat Anda.');
    }
}
