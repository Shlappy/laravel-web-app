<?php declare(strict_types=1);

namespace Tests\Feature\Filters;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductFiltersTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_product_filters_can_filter()
    {
        $category = Category::factory()->create();

        $response = $this->post("/products/$category->slug");

        $response->assertStatus(200);
    }
}
