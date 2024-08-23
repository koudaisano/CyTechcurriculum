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
        $product = new Product();
        return view('create', compact('companies', 'product'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'company_id' => 'required|exists:companies,id',
        ]);

        // 新規商品の作成
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->company_id = $request->input('company_id');
        $product->comment = $request->input('comment');

        if($request->hasFile('product_image')){
            $product->img_path = $request->file('product_image')->store('images', 'public');
        }

        //商品を保存
        $product->save();
        return redirect()->route('products.index')->with('success','商品作成されました' );
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
