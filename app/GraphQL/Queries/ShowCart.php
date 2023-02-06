<?php

namespace App\GraphQL\Queries;

use App\Models\Product;
use App\Models\User;

final class ShowCart
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $cart = User::find($args['user'])->cart;

        return Product::whereIn('id', $cart)->get();
    }
}
