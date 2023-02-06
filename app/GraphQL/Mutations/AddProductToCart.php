<?php

namespace App\GraphQL\Mutations;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

final class AddProductToCart
{
    /**
     * @param null $_
     * @param array{} $args
     * @return Collection|array
     */
    public function __invoke($_, array $args): Collection|array
    {
        /** @var User $user */
        $user = Auth::user();
        $user->carts()->create(['product_id' => $args['product']]);
        $user->save();
        return Cart::query()
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->where('user_id', $user->id)
            ->select(['products.*', DB::raw('count(carts.product_id) as quantity')])
            ->groupBy(['carts.product_id'])
            ->get();
    }
}
