<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Events\PurchaseOutStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
   /*
    |--------------------------------------------------------------------------
    | set index page view
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        if($request->ajax()){
            $sales = Sale::all();
            return DataTables::of($sales)
                    ->addIndexColumn()
                    ->addColumn('product',function($sale){
                        $image = '';
                        if(!empty($sale->product)){
                            $image = null;
                            if(!empty($sale->product->purchase->image)){
                                $image = '<span class="avatar avatar-sm mr-2">
                                <img class="avatar-img" src="'.asset("storage/purchases/".$sale->product->purchase->image).'" alt="image">
                                </span>';
                            }
                            return $image . ' ' . $sale->product->purchase->product;
                        }
                    })
                    ->addColumn('total_price',function($sale){
                        return $sale->total_price;
                    })
                    ->addColumn('date',function($row){
                        return date_format(date_create($row->created_at),'d M, Y');
                    })
                    ->addColumn('action', function ($row) {
                        $editbtn = '<a href="#" id="' . $row->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editSalesModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a href="#" id="' . $row->id . '" name="' . $row->product   .'" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['product','action'])
                    ->make(true);

        }
        $products = Product::get();
        return view('admin.pages.sales.index',compact(
            'products'
        ));
    }
    /*
    |--------------------------------------------------------------------------
    | handle insert a new Sales ajax request
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);
        $sold_product = Product::find($request->product);
        /**update quantity of
            sold item from
         purchases
        **/
        $purchased_item = Purchase::find($sold_product->purchase->id);
        $new_quantity = ($purchased_item->quantity) - ($request->quantity);
        if (!($new_quantity < 0)){
            $purchased_item->update([
                'quantity'=>$new_quantity,
            ]);

            /**
             * calcualting item's total price
            **/
            $total_price = ($request->quantity) * ($sold_product->price);
            Sale::create([
                'product_id'=>$request->product,
                'quantity'=>$request->quantity,
                'total_price'=>$total_price,
            ]);
            session()->flash('success','Product has been sold');
        }
        if($new_quantity <=1 && $new_quantity !=0){
            // send notification
            $product = Purchase::where('quantity', '<=', 1)->first();
            event(new PurchaseOutStock($product));
            // end of notification
            session()->flash('error','Product is running out of stock!!!');
        }
        return redirect()->route('sales.index');
    }
    /*
    |--------------------------------------------------------------------------
    | handle edit an Sales
    |--------------------------------------------------------------------------
    */
    public function edit(Request $request)
     {
       $id = $request->id;
       $sale = Sale::find($id);
       return response()->json($sale);
     }
     /*
    |--------------------------------------------------------------------------
    | handle update an Sales ajax request
    |--------------------------------------------------------------------------
    */

    public function update(Request $request ,Sale $sale)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);
        $sold_product = Product::find($request->product);
        /**
         * update quantity of sold item from purchases
        **/
        $purchased_item = Purchase::find($sold_product->purchase->id);
        if(!empty($request->quantity)){
            $new_quantity = ($purchased_item->quantity) - ($request->quantity);
        }
        $new_quantity = $sale->quantity;
        if (!($new_quantity < 0)){
            $purchased_item->update([
                'quantity'=>$new_quantity,
            ]);
            /**
             * calcualting item's total price
            **/
            if(!empty($request->quantity)){
                $total_price = ($request->quantity) * ($sold_product->price);
            }
            $total_price = $sale->total_price;
            $sale->update([
                'product_id'=>$request->product,
                'quantity'=>$request->quantity,
                'total_price'=>$total_price,
            ]);

            session()->flash('success','Product has been updated');
        }
        if($new_quantity <=1 && $new_quantity !=0){
            // send notification
            $product = Purchase::where('quantity', '<=', 1)->first();
            event(new PurchaseOutStock($product));
            // end of notification
            session()->flash('error','Product is running out of stock!!!');

        }
        return redirect()->route('sales.index');
    }

     /*
    |--------------------------------------------------------------------------
    | handle delete an Sales ajax request
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        return Sale::findOrFail($request->id)->delete();
    }
    /*
    |--------------------------------------------------------------------------
    | handle an Sales reports view
    |--------------------------------------------------------------------------
    */
    public function reports(){
        $sales = Sale::get();
        return view('admin.pages.sales.reports',compact(
            'sales'
        ));
    }
    /*
    |--------------------------------------------------------------------------
    | handle an Sales generateReport reports view
    |--------------------------------------------------------------------------
    */
    public function generateReport(Request $request){
        $this->validate($request,[
            'from_date' => 'required',
            'to_date' => 'required',
        ]);
        $sales = Sale::whereBetween(DB::raw('DATE(created_at)'), array($request->from_date, $request->to_date))->get();
        return view('admin.pages.sales.reports',compact(
            'sales'
        ));
    }
}
