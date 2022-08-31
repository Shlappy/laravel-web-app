<?php

namespace Tests\Feature\Auth;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RemoveFromCartTest extends TestCase
{
    use DatabaseTransactions;

    public function test_product_can_be_removed_from_cart()
    {
        $product = Product::factory()->create();

        $response = $this->post('/cart', ['id' => $product->id]);
        $response = $this->post('/cart-remove', ['id' => $product->id]);

        $response->assertStatus(200);
    }

    public function test_cart_can_be_cleared()
    {
        $product = Product::factory()->create();

        $response = $this->post('/cart', ['id' => $product->id]);
        $response = $this->post('/cart-clear');

        $response->assertStatus(200);
    }
}
