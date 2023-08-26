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

    session()->flash('success','Inventory has been Deleted');
}



}
