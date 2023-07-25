<?php

namespace App\Http\Controllers\Admin;
use QCod\AppSettings\Setting\AppSettings;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | set index page view
    |--------------------------------------------------------------------------
    */
    public function index()
    {

        $purchase = \DB::table('purchases')->get();
        $purchases ['purchases'] = $purchase;
        return view('admin.pages.product.index',$purchases);
        
    }
    /*
    |--------------------------------------------------------------------------
    | handle fetch all Product ajax request
    |--------------------------------------------------------------------------
    */
	public function fetchAll() {
		try {
            $product = Product::all();

            // $Product = DB::table('Products as p')
            //         ->leftJoin('categories as c', function($join) {
            //             $join->on('c.id', '=', 'p.category_id');
            //         })
            //         ->leftJoin('suppliers as s', function($join) {
            //             $join->on('s.id', '=', 'p.supplier_id');
            //         })->get(['p.*','c.name as category_name','s.name as as supplier_name']);

            $output = '';
            if ($product->count() > 0) {
                $output .= '<table class="table table-striped table-sm align-middle">
            <thead>
              <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Expire Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($product as $item) {
                    $output .= '<tr>
                <td class="sorting_1">
                <h2 class="table-avatar">
                <img class="avatar" src="'.asset("storage/purchases/".$item->purchase->image).'" alt="product">
                <a href="profile.html"><span>' . $item->purchase->product . '</span></a>
                </h2>
                </td>
                <td>' . $item->purchase->category->name . '</td>
                <td>' . $item->price . '</td>
                <td>' . $item->discount . '</td>
                <td>' . $item->purchase->quantity . '</td>
                <td>' . $item->purchase->expiry_date . '</td>
                <td>
                  <a href="#" id="' . $item->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editProductModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

                  <a href="#" id="' . $item->id . '" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                </td>
              </tr>';
                }
                $output .= '</tbody></table>';
                echo $output;
                
            } else {
                echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
            }
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
    }
    /*
    |--------------------------------------------------------------------------
    | handle insert a new Product ajax request
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product'=>'required|max:200',
            'price'=>'required|min:1',
            'discount'=>'nullable',
            'description'=>'nullable|max:255',
        ]);
        $price = $request->price;
        if($request->discount >0){
           $price = $request->discount * $request->price;
        }
        Product::create([
            'purchase_id'=>$request->product,
            'price'=>$price,
            'discount'=>$request->discount,
            'description'=>$request->description,
        ]);
        // $notifications = notify("Product has been added");
        return response()->json([
            'status' => 200,
        ]);
    }
     /*
    |--------------------------------------------------------------------------
    | handle edit an Product ajax request
    |--------------------------------------------------------------------------
    */
    public function edit(Request $request)
     {
       $id = $request->id;
       $Product = Product::find($id);
       return response()->json($Product);
     }
    /*
    |--------------------------------------------------------------------------
    | handle update an Product ajax request
    |--------------------------------------------------------------------------
    */
     // 
     public function update(Request $request)
     {
        $products = Product::find($request->id);
        $this->validate($request,[
            'product'=>'required|max:200',
            'price'=>'required',
            'discount'=>'nullable',
            'description'=>'nullable|max:255',
        ]);
        
        $price = $request->price;
        if($request->discount >0){
           $price = $request->discount * $request->price;
        }
       $products->update([
            'purchase_id'=>$request->product,
            'price'=>$price,
            'discount'=>$request->discount,
            'description'=>$request->description,
        ]);
        return response()->json([
            'status' => 200,
        ]);
     }
     /*
    |--------------------------------------------------------------------------
    | set outstock page view
    |--------------------------------------------------------------------------
    */
    public function outstock()
    {
        return view('admin.pages.product.outstock');
    }
     /*
    |--------------------------------------------------------------------------
    | handle delete an outstocked Products ajax request
    |--------------------------------------------------------------------------
    */
    
    public function stockAllProduct(Request $request) {
        try{
            $product = Purchase::where('quantity', '<=', 0)->get();
            dd($product);
            // $product = Product::all();
            // $Product = DB::table('Products as p')
            //         ->leftJoin('categories as c', function($join) {
            //             $join->on('c.id', '=', 'p.category_id');
            //         })
            //         ->leftJoin('suppliers as s', function($join) {
            //             $join->on('s.id', '=', 'p.supplier_id');
            //         })->get(['p.*','c.name as category_name','s.name as as supplier_name']);
            $output = '';
            if ($product->count() > 0) {
                $output .= '<table class="table table-striped table-sm align-middle">
            <thead>
              <tr>
                <th>Product</th>
                <th>Category</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Expire Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($product as $item) {
                    $output .= '<tr>
                <td class="sorting_1">
                <h2 class="table-avatar">
                <img class="avatar" src="'.asset("storage/purchases/".$item->image).'" alt="product">
                <a href="profile.html"><span>' . $item->product . '</span></a>
                </h2>
                </td>
                <td>' . $item->category->name . '</td>
                <td>' . $item->products->price . '</td>
                <td>' . $item->products->discount . '</td>
                <td>' . $item->quantity . '</td>
                <td>' . $item->expiry_date . '</td>
                <td>
                  <a href="#" id="' . $item->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editProductModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

                  <a href="#" id="' . $item->id . '" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                </td>
              </tr>';
                }
                $output .= '</tbody></table>';
                echo $output;
                
            } else {
                echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
            }
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
   
    }
    /*
    |--------------------------------------------------------------------------
    | handle delete an Product ajax request
    |--------------------------------------------------------------------------
    */
    public function delete(Request $request)
    {
        try {
            $id = $request->id;
            Product::destroy($id);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => $e
            ], 500);
        }
    }

}
