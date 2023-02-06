<?php

namespace Tests\GraphQL\Queries;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\GraphQl\TestCase;

class ShowCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_queries(): void
    {
        $product = Product::factory()->count(3)->create()->first();

        /** @var User $user */
        $user = User::factory()->create();
        $user->carts()->createMany([['product_id' => 1], ['product_id' => 3]]);
        $user->save();

        $this->graphQL(/** @lang GraphQL */'
            query ShowCart {
                showCart(user: 1) {
                    id
                }
            }
        ')->assertJson([
            'data' => [
                'showCart' => null
            ]
        ]);

        $this->actingAs($user)
            ->graphQL(/** @lang GraphQL */'
                query ShowCart {
                    showCart(user: 1) {
                        id
                        name
                        description
                        price
                    }
                }
            ')->assertJson([
                'data' => [
                    'showCart' => [
                        [
                            'id' => $product->id,
                            'name' => $product->name,
                            'description' => $product->description,
                            'price' => $product->price,
                        ]
                    ]
                ]
            ]);
    }
}
