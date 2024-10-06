<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_purchase_product()
    {
        // 商品を作成
        $product = \App\Models\Product::factory()->create();

        // 購入リクエストを送信
        $response = $this->postJson('/api/purchase', [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        // レスポンスの確認
        $response->assertStatus(201);
        $this->assertDatabaseHas('sales', [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);
    }
}
