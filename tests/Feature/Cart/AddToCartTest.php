<?php

namespace Tests\Feature\Auth;

use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AddToCartTest extends TestCase
{
    use DatabaseTransactions;

    public function test_product_can_be_added()
    {
        $product = Product::factory()->create();

        $response = $this->post('/cart', ['id' => $product->id]);

        $response->assertStatus(200);
    }

    public function test_product_cannot_be_added_with_wrong_data()
    {
        $response = $this->post('/cart', ['id' => '1111-22222-333333']);

        $response->assertNotFound();
    }
}
