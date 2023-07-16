<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // return view('pages.product.product')->with('products',Product::all());
        if ($request->ajax()) {
            $data = Product::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.product.product');
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
