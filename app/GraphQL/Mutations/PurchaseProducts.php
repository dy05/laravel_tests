<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use App\Models\Order;
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

        // We make a select distinct for test
        $cart = Cart::query()
            ->where(['user_id' => $user->id]);
        $products = $cart
            ->distinct()
            ->pluck('product_id')
            ->toArray();

        if (($products_count = count($products)) < 1) {
            throw new Error('Empty cart');
        }

        /** @var Order $order */
        $order = Order::create(['user_id' => $user->id, 'total' =>$products_count]);
        foreach ($products as $item) {
            $order->products()->attach($item);
        }
        $order->save();
        $order->fresh()->load(['user', 'products']);
        $cart->delete();
        return $order;
    }
}
