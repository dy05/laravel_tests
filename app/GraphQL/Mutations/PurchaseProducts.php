<?php

namespace App\GraphQL\Mutations;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Error;
use Illuminate\Support\Facades\Auth;

final class PurchaseProducts
{
    /**
     * @param null $_
     * @param array{} $args
     * @return Order
     */
    public function __invoke($_, array $args): Order
    {
        /** @var User $user */
        $user = Auth::user();

        $cart = $user->cart_products();

        /** @var Product[] $products */
        $products = $cart->get();

        if (count($products) < 1) {
            throw new Error('Empty cart');
        }

        /** @var Order $order */
        $order = Order::create(['user_id' => $user->id, 'total' => $total = 0]);
        foreach ($products as $product) {
            $attributes = [
                'quantity' => $product->cart_quantity,
                'unit_price' => $product->price,
                'total_price' => (double) $product->cart_quantity * (double) $product->price,
                'details' => ''
            ];
            $order->products()->attach($product->id, $attributes);
            $total += $attributes['total_price'];
        }

        $order->total = $total;
        $order->save();
        $order->fresh()->load(['user', 'products']);
        $cart->delete();
        return $order;
    }
}
