<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

final class RemoveProductFromCart
{
    /**
     * @param null $_
     * @param array{} $args
     * @return mixed
     */
    public function __invoke($_, array $args): mixed
    {
        /** @var User $user */
        $user = Auth::user();
        Cart::query()->where(['product_id' => $args['product']])->delete();
        $user->save();
        $user->fresh();
        return $user->cart;
    }
}
