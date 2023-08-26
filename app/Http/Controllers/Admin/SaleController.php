<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
    public function index()
    {
        $products = Product::get();
        $customers = Customer::get();
        return view('admin.pages.sales.index',compact(
            'products','customers'
        ));
    }
   /*
    |--------------------------------------------------------------------------
    | fetchAll Product
    |--------------------------------------------------------------------------
    */
    public function fetchAll() {
		try {
            $product = Product::all();
            $output = '';
            if ($product->count() > 0) {
                $output .= '<table class="table table-striped table-sm align-middle" id="tablebtn">
            <thead>
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Quantity</th>
                <th>Add to cart</th>
              </tr>
            </thead>
            <tbody>';
                foreach ($product as $item) {
                    $output .= '<tr>
                <td class="sorting_1">
                <h2 class="table-avatar">
                <img class="avatar" src="'.asset("storage/purchases/".$item->purchase->image).'" alt="product">
                <span>' . $item->purchase->product . '</span>
                </h2>
                </td>

                <td>' . $item->price . '</td>
                <td>' . $item->discount . '</td>
                <td>' . $item->purchase->quantity . '</td>
                <td>
                <button onclick="rowAdd('.$item->id.')" price="' . $item->price . '" id="pro-'. $item->id . '" name="' . $item->purchase->product . '" class="btn btn-success text-white add_field_button"
                    title="Add"><i class="fa fa-plus"></i> Add
                    </button>
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
    | handle insert a new Sales ajax request
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
//       dd($request->input());

       $sale = DB::table('sales')->insertGetId([
          'customer_id' => $request->customer_id,
          'sub_total' => $request->sub_total,
          'discount' => $request->discount,
          'total' => $request->total,
          'paid_by' => $request->paid_by,
          'amount_paid' => $request->amount_paid,
          'due_return' => $request->due_return,
       ]);

       $product_count = count($request->product_id);

       for ($i=0; $i < $product_count; $i++){
           DB::table('salesdetails')->insert([
               'sale_id' => $sale,
               'product_id' => $request->product_id[$i],
               'qty' => $request->qty[$i],
               'rate' => $request->rate[$i],
               'price' => $request->price[$i],
           ]);

//           $product_qty = DB::table('products')->where('id', $request->product_id[$i])->first(['quantity']);
//
//           $current_qty = (int) $product_qty->quantity - $request->qty[$i];
//
//           DB::table('products')->update([
//               'quantity' => $current_qty,
//           ]);
       }




       dd($sale);

        return response()->json(['message' => 'Data inserted successfully','data'=>$inputsArray,'customer_id'=>$customer_id]);
//        return redirect()->route('sales.index');
    }
//    public function store(Request $request)
//    {
//         dd($request->inputs);
//        $dataArray = $request->inputs;
//        $customer_id = $request->customer_id;

//        foreach ($dataArray as $data) {
//            Sale::create($data);
//
//        }
//            Sale::create([
//                'customer_id'=>$request->customer_id,
//            ]);
//        return response()->json(['message' => 'Data inserted successfully','data'=>$dataArray,'customer_id'=>$customer_id]);
//        $this->validate($request,[
//            'product'=>'required',
//            'quantity'=>'required|integer|min:1'
//        ]);
//        $sold_product = Product::find($request->product);
//        /**update quantity of
//            sold item from
//         purchases
//        **/
//        $purchased_item = Purchase::find($sold_product->purchase->id);
//        $new_quantity = ($purchased_item->quantity) - ($request->quantity);
//        if (!($new_quantity < 0)){
//            $purchased_item->update([
//                'quantity'=>$new_quantity,
//            ]);
//            /**
//             * calcualting item's total price
//            **/
//            $total_price = ($request->quantity) * ($sold_product->price);
//            Sale::create([
//                'product_id'=>$request->product,
//                'quantity'=>$request->quantity,
//                'total_price'=>$total_price,
//            ]);
//            session()->flash('success','Product has been sold');
//        }
//        if($new_quantity <=1 && $new_quantity !=0){
//            // send notification
//            $product = Purchase::where('quantity', '<=', 1)->first();
//            event(new PurchaseOutStock($product));
//            // end of notification
//            session()->flash('error','Product is running out of stock!!!');
//        }
//        return redirect()->route('sales.index');
//    }
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
