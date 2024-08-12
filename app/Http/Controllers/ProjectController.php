<?php

namespace App\Http\Controllers;

use App\Models\Companie;
use App\Models\Product;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // 一覧表示
    public function index()
    {
$this->posts = new Product();
$Id = 24; // 適切な ID に置き換え
$companyName = $this->CompanyNameById($Id);
$results = Product::where('company_id', $Id)->get();



return view('index', compact('results',));

    }

    public function CompanyNameById($id)
    {
        $company = Companie::find($id);

    }

    // 商品作成フォーム表示
    public function create()
    {
        return view('products.create');
    }

    // 商品の保存
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        // 商品の作成
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', '商品が作成されました。');
    }

    // 商品詳細表示
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // 商品編集フォーム表示
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // 商品の更新
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', '商品が更新されました。');
    }

    // 商品の削除
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', '商品が削除されました。');
    }
}
