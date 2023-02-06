<?php

namespace Tests\GraphQL\Mutations;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GraphQl\TestCase;

class AddProductToCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_mutations(): void
    {
        $product = Product::factory()->count(3)->create()->first();

        /** @var User $user */
        $user = User::factory()->create();

        $this->be($user);

        $this->graphQL(/** @lang GraphQL */'
            mutation {
                addProductToCart(product: 1) {
                    id
                    name
                    price
                }
            }
        ')->assertJson([
            'data' => [
                'addProductToCart' => [
                    [
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                    ]
                ]
            ]
        ]);
    }
}
