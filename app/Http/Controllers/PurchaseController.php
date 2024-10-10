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

        //製品を取得・在庫チェックを行う処理
        $product = Product::findOrFail($productId);

        if ($product->stock < $quantity) {
           return response()->json(['success' => false, 'message' => '在庫が不足しています。'], 422);
         }
         DB::beginTransaction();

        try {
            //在庫を減少させて保存の処理
            $product->stock -= $quantity;
            $product->save();

            //販売記録を作成する処理
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
