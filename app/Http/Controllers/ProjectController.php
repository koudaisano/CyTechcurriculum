<?php

namespace App\Http\Controllers;

use App\Models\Companie;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProjectController extends Controller
{
    // 一覧表示
    public function index()
    {
        $products = Product::join('companies', 'products.company_id', '=', 'companies.id')
        ->select('products.*', 'companies.company_name')
        ->paginate(6);

        $companies = Companie::all();
        $id = 24;
        $results = $this->CompanyNameById($id);
        return view('index', compact('results','products','companies'));
    }

    public function CompanyNameById($id)
    {
        return Product::join('companies', 'products.company_id', '=', 'companies.id')
        ->where('products.id', $id)
        ->select('companies.company_name')
        ->get();
    }

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
        ]);

        // 新規商品の作成
        $product = new Product([
        'product_name' => $request->get('product_name'),
        'company_id' => $request->get('company_id'),
        'price' => $request->get('price'),
        'stock' => $request->get('stock'),
        'comment' => $request->get('comment'),
    ]);

        if($request->hasFile('img_path')){
         $filename = $request->img_path->getClientOriginalName();
         $filePath = $request->img_path->storeAs('products', $filename, 'public');
         $product->img_path = '/storage/' . $filePath;
        }

        //商品を保存
        $product->save();
    }

    // 商品詳細表示
     public function show(Product $product)
    {
        return view('show', compact('product'));
    }

    // 商品編集フォーム表示
    public function edit(Product $product)
    {
        return view('edit', compact('product'));
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
    public function destroy(Product $product)
    {
        // 商品の削除処理
        $product->delete();

        // 削除後にリダイレクト
        return redirect()->route('products.index')->with('success', '商品が削除されました。');
    }
}

