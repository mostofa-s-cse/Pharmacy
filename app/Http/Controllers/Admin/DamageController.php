<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Damage;
use App\Models\Product;
use App\Models\Purchase;
use App\Events\PurchaseOutStock;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class DamageController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request->ajax()){
            $damages = Damage::all();
            return DataTables::of($damages)
                    ->addIndexColumn()
                    ->addColumn('product',function($damage){
                        $image = '';
                        if(!empty($damage->product)){
                            $image = null;
                            if(!empty($damage->product->purchase->image)){
                                $image = '<span class="avatar avatar-sm mr-2">
                                <img class="avatar-img" src="'.asset("storage/purchases/".$damage->product->purchase->image).'" alt="image">
                                </span>';
                            }
                            return $image . ' ' . $damage->product->purchase->product;
                        }
                    })
                    ->addColumn('total_price',function($damage){
                        return $damage->total_price;
                    })
                    ->addColumn('date',function($row){
                        return date_format(date_create($row->created_at),'d M, Y');
                    })
                    ->addColumn('action', function ($row) {
                        $editbtn = '<a href="#" id="" ' . $row->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editSalesModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a href="#" id="  ' . $row->id . '" name="' . $row->product   .'" class="text-danger mx-1 deleteDamageProduct"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['product','action'])
                    ->make(true);

        }
        $products = Product::get();
        return view('admin.pages.damage.index',compact(
            'products'
        ));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);
        $sold_product = Product::find($request->product);
        /**update quantity of
            damag item from
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
            Damage::create([
                'product_id'=>$request->product,
                'quantity'=>$request->quantity,
                'total_price'=>$total_price,
            ]);
            session()->flash('success','Damaged Product Added Successfully!');
        }
        if($new_quantity <=1 && $new_quantity !=0){
            // send notification
            $product = Purchase::where('quantity', '<=', 1)->first();
            event(new PurchaseOutStock($product));
            // end of notification
            session()->flash('error','Product is running out of stock!!!');
        }
        return redirect()->route('damage.index');
    }

    public function edit(Request $request)
     {
       $id = $request->id;
       $damage = Damage::find($id);
       return response()->json($damage);
     }

 /*
    |--------------------------------------------------------------------------
    | handle update an Sales ajax request
    |--------------------------------------------------------------------------
    */

    public function update(Request $request ,Damage $damage)
    {
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required|integer|min:1'
        ]);
        $damage_product = Product::find($request->product);
        /**
         * update quantity of sold item from purchases
        **/
        $purchased_item = Purchase::find($damage_product->purchase->id);
        if(!empty($request->quantity)){
            $new_quantity = ($purchased_item->quantity) - ($request->quantity);
        }
        $new_quantity = $damage->quantity;
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
            $total_price = $damage->total_price;
            $damage->update([
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
        return redirect()->route('damage.index');
    }



    
     /*
    |--------------------------------------------------------------------------
    | handle delete an Sales ajax request
    |--------------------------------------------------------------------------
    */
    public function destroy(Request $request)
    {
        return Damage::findOrFail($request->id)->delete();
    }
    

     
    
}

