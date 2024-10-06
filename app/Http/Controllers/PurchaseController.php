<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];

        DB::beginTransaction();

        try {
            $product = Product::findOrFail($productId);

            if ($product->stock < $quantity) {
                return response()->json(['success' => false, 'message' => '在庫が不足しています。'], 400);
            }

            $product->stock -= $quantity;
            $product->save();


            Sale::create([
                'product_id' => $productId,
                'quantity' => $quantity,
                'sale_date' => now(),
            ]);

            DB::commit();

            return response()->json(['success' => true, 'message' => '購入が完了しました'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => '購入処理中にエラーが発生しました。'], 500);
        }
    }
}
