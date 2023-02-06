<?php

namespace App\GraphQL\Queries;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final class ShowCart
{
    /**
     * @param null $_
     * @param array{} $args
     * @return mixed
     */
    public function __invoke($_, array $args): mixed
    {
        return User::find($args['user'])->cart;
    }
}
