<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
   public function addToCart(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $user = auth()->user();
    $product = Product::findOrFail($request->product_id);

    if ($product->stock < $request->quantity) {
        return response()->json(['error' => 'Not enough stock available'], 400);
    }

    $product->stock -= $request->quantity;
    $product->save();

    $existing = $user->cart()->where('product_id', $product->id)->first();

    if ($existing) {
        $existing->quantity += $request->quantity;
        $existing->save();
        $cart = $existing;
    } else {
        $cart = $user->cart()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);
    }

    return response()->json(['message' => 'Added to cart', 'cart' => $cart]);
}


    public function getCart()
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();
    
        $total = 0;
        $items = $cartItems->map(function ($item) use (&$total) {
            $priceToUse = $item->product->discount_price ?? $item->product->price;
            $subtotal = $item->quantity * $priceToUse;
            $total += $subtotal;
    
            return [
                'id' => $item->id,
                'product_id' => $item->product->id,
                'name' => $item->product->name,
                'image' => $item->product->image,
                'price' => $priceToUse,
                'quantity' => $item->quantity,
                'subtotal' => $subtotal
            ];
        });
    
        return response()->json([
            'items' => $items,
            'total' => $total
        ]);
    }
    

    public function removeFromCart($productId)
    {
        Cart::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['status' => 'success', 'message' => 'Item removed from cart']);
    }

    public function clearCart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return response()->json(['status' => 'success', 'message' => 'Cart cleared']);
    }

    public function updateQuantity(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $cartItem = Cart::where('user_id', Auth::id())
        ->where('product_id', $productId)
        ->first();

    if (!$cartItem) {
        return response()->json(['status' => 'error', 'message' => 'Item not found in cart'], 404);
    }

    $oldQuantity = $cartItem->quantity;
    $newQuantity = $request->quantity;
    $diff = $newQuantity - $oldQuantity;

    $product = Product::find($productId);

    // Adjust stock based on diff
    if ($diff > 0) {
        // Want to increase cart quantity → decrease product stock
        if ($product->stock < $diff) {
            return response()->json(['error' => 'Not enough stock available'], 400);
        }
        $product->stock -= $diff;
    } else {
        // Reducing quantity → restore stock
        $product->stock += abs($diff);
    }

    $product->save();
    $cartItem->quantity = $newQuantity;
    $cartItem->save();

    return response()->json(['status' => 'success', 'message' => 'Cart updated successfully']);
}

}
