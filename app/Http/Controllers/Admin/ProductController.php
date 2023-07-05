<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.product.product')->with('products',Product::all());
    }

    public function create()
    {
        $this->validate(request(),
        [
            'name' => 'required|min:2|max:200',
            'description'=>'required',
            // 'quantity'=>'required'
        ]);
        $data=request()->all();
        $products = new Product();
        $products->name = $data['name'];
        $products->description = $data['description'];
        $products->quantity = $data['quantity']; 
        $products -> save();
        session()->flash('success','Product Created Successfully');
        return redirect('/admin/products');
    }

    public function destroy(Request $request)
    {
        // dd($request->input());
        Product::find($request->product_id)->delete();
        session()->flash('success','Product Delete Successfully');
        return redirect('/admin/products');
    }
}
