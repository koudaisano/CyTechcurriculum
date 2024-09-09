<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Companie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    // 一覧表示
    public function index(Request $request)
{
    $query = Product::join('companies', 'products.company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name');

    // 商品名の部分一致検索
    if ($request->filled('product_name')) {
        $query->where('products.product_name', 'LIKE', '%' . $request->input('product_name') . '%');
    }

    // 企業名による絞り込み
    if ($request->filled('company_id')) {
        $query->where('products.company_id', $request->input('company_id'));
    }

    if ($request->filled('company_name')) {
        $query->where('companies.company_name', 'LIKE', '%' . $request->input('company_name') . '%');
    }

    $products = $query->paginate(6)->appends($request->query());
    $companies = Companie::all();

    // 特定のIDを持つ企業名を取得
    $id = 24;
    $results = Product::getCompanyNameById($id);
    return view('index', compact('products', 'companies', 'results'));
}

    // public function CompanyNameById($id)
    // {
    //     return Product::join('companies', 'products.company_id', '=', 'companies.id')
    //     ->where('products.id', $id)
    //     ->select('companies.company_name')
    //     ->get();
    // }

    // 商品作成フォーム表示
    public function create()
    {
        $companies = Companie::all();
        return view('create', compact('companies'));
    }

    public function store(Request $request)
    {
            $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'company_id' => 'required|exists:companies,id',
            'comment' => 'nullable',
            'img_path' => 'nullable|image',
        ],[
            'product_name.required' => '商品名は入力必須項目です。',
            'product_name.max' => '商品名は255文字以内で入力してください。',
            'price.required' => '価格は入力必須項目です。',
            'price.numeric' => '価格には数字のみを入力してください。',
            'stock.required' => '在庫数は入力必須項目です。',
            'stock.numeric' => '在庫数には数字のみを入力してください。',
            'company_id.required' => 'メーカー名は選択必須です。',
        ]);


        if ($request->hasFile('img_path')){
            $image = $request->file('img_path');
            $path = $image->store('public/images');
            $path = str_replace('public/', '', $path);
           } else {
               $path = null;
           }

        // 新規商品の登録処理
        $product = new Product($request->input());
        $product->img_path = $path;
        $product->save();

        return redirect()->route('products.create')->with('success', '商品が登録されました。');
    }

    // 商品詳細表示
    public function show(Product $product)
    {
        return view('show', compact('product'));
    }

    // 商品編集フォーム表示
    public function edit(Product $product)
    {
        $companies = Companie::all();
        return view('edit', compact('product', 'companies'));
    }

    // 商品の更新
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'company_id' => 'required|exists:companies,id',
            'comment' => 'nullable',
            'img_path' => 'nullable|image',
        ],[
            'product_name.required' => '商品名は入力必須項目です。',
        'product_name.max' => '商品名は255文字以内で入力してください。',
        'price.required' => '価格は入力必須項目です。',
        'price.numeric' => '価格には数字のみを入力してください。',
        'stock.required' => '在庫は入力必須項目です。',
        'stock.numeric' => '在庫数には数字のみを入力してください。',
        'company_id.required' => 'メーカー名は選択必須です。',
        ]);

        Log::info('Form data', ['data' => $request->all()]);

        $product = Product::findOrFail($id);
        Log::info('Product found', ['product' =>$product]);

            // 画像がアップロードされた場合の処理
        if($request->hasFile('img_path')) {
            Log::info('Image file found in request');
            $newImagePath = $request->file('img_path')->store('images', 'public');
            $image = $request->file('img_path');
            $path = $image->store('public/images');
            Log::info('Image stored', ['path' => $path]);

            // 必要であれば古い画像を削除する
            if($product->img_path){
                $oldImagePath = 'public/images/' . $product->img_path;
                if (\Storage::exists($oldImagePath)) {
                    \Storage::delete($oldImagePath);
                    Log::info('Old image deleted', ['old_path' => $oldImagePath]);
                }
            }
            // 新しい画像パスを設定
            $product->img_path = $newImagePath;
            Log::info('New image path set', ['new_path' => $product->img_path]);

        }
        $product->save();
        $updateData = $request->only(['product_name', 'price', 'stock', 'company_id', 'comment']);
    $product->update($updateData);
        Log::info('Product updated successfully', ['product' =>$product]);
        return redirect()->route('products.edit', ['product' => $product->id])->with('success', '商品が更新されました。');
    }

    // 商品の削除
    public function destroy(Product $product)
    {
        // 商品の削除処理
        $product->delete();

        // 削除後にリダイレクト
        return redirect()->route('products.index')->with('success', '商品が削除されました。');
    }
}
