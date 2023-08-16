<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    //
    public $inventory;

    public function index(){
        $inventory = Inventory::get();
        return view('admin.Pages.inventory.index',compact('inventory'));
    }


     /*
    |--------------------------------------------------------------------------
    | handle fetch all Inventory ajax request
    |--------------------------------------------------------------------------
    */
    // public function fetchAll()
    // {
    //     try {
    //         $inventory = Inventory::all();
    //         $output = '';
    //         if ($inventory->count() > 0) {
    //             $output .= '<table class="table table-striped table-sm text-center align-middle">
    //         <thead>
    //           <tr>
                // <th>SN</th>
                // <th>Product Name</th>
                // <th>Shope Name</th>
                // <th>Quantity</th>
                // <th>Amount</th>
                // <th>Purchase Date</th>
                // <th>Action</th>
    //           </tr>
    //         </thead>
    //         <tbody>';
    //             foreach ($inventory as $inventories) {
    //                 $output .= '<tr>
    //             <td>' . $inventories->id . '</td>
    //             <td>' . $inventories->product_name . '</td>
    //             <td>' . $inventories->shope_name . '</td>
    //             <td>' . $inventories->quantity . '</td>
    //             <td>' . $inventories->amount . '</td>
    //             <td>' . $inventories->purchase_date . '</td>
    //             <td>
    //               <a href="#" id="' . $inventories->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

    //               <a href="#" id="' . $inventories->id . '" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
    //             </td>
    //           </tr>';
    //             }
    //             $output .= '</tbody></table>';
    //             echo $output;
    //         } else {
    //             echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
    //         }
    //     } catch (\Exception $e) {
    //         // Return Json Response
    //         return response()->json([
    //             'message' => $e
    //         ], 500);
    //     }
    // }
   /*
   |--------------------------------------------------------------------------
   | handle insert a new Inventory ajax request
   |--------------------------------------------------------------------------
   */

   //'product_name','shope_name','quantity','amount','purchase_date',
    public function store(Request $request)
    {
        $inventory =  new Inventory;
        $inventory->id = $request->id;
        $inventory->product_name = $request->product_name;
        $inventory->shope_name = $request->shope_name;
        $inventory->quantity = $request->quantity;
        $inventory->amount = $request->amount;
        $inventory->purchase_date = $request->purchase_date;
        $inventory->save();

        return redirect('/admin/inventories');
    }
   /*
   |--------------------------------------------------------------------------
   | handle edit an Inventory ajax request
   |--------------------------------------------------------------------------
   */
  public function edit($id){
    $inventory=Inventory::find($id);
    return view('admin.Pages.inventory.index',['inventory'=>$inventory]);
    }

public function update(Request $request , $id)
{
    $inventory= Inventory::find($id);
    $inventory->product_name = $request->product_name;
    $inventory->shope_name = $request->shope_name;
    $inventory->quantity = $request->quantity;
    $inventory->amount = $request->amount;
    $inventory->purchase_date = $request->purchase_date;
    $inventory->save();

    // return redirect('/admin/inventories');
    return redirect('/admin/inventories')->with('status','Updated Succesfully');
}

public function delete($id){
    $inventory= Inventory::find($id);
    $inventory->delete();
    return redirect('/admin/inventories')->with('status','Inventory deleted Successfully');
}



}
