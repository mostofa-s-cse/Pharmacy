<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            $supplier = Supplier::get();
            return DataTables::of($supplier)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editbtn = '<a href="'.route("supplier.update", $row->id).'" class="editbtn"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('supplier.delete', $row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        return view('admin.pages.supplier.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:4|max:255',
            'product'=>'required',
            'email'=>'nullable|email|string',
            'phone'=>'nullable|min:10|max:20',
            'company'=>'nullable|max:200|required',
            'address'=>'nullable|required|max:200',
            'comment' =>'nullable|max:255',
        ]);
        Supplier::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company'=>$request->company,
            'address'=>$request->address,
            'product'=>$request->product,
            'comment'=>$request->comment,
        ]);
        $notification = notify("Supplier has been added");
        return redirect()->route('supplier.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request,[
            'name'=>'required|min:10|max:255',
            'product'=>'required',
            'email'=>'nullable|email|string',
            'phone'=>'nullable|min:10|max:20',
            'company'=>'nullable|max:200|required',
            'address'=>'nullable|required|max:200',
            'comment' =>'nullable|max:255',
        ]);
        $supplier->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company'=>$request->company,
            'address'=>$request->address,
            'product'=>$request->product,
            'comment'=>$request->comment,
        ]);
        $notification = notify("Supplier has been added");
        return redirect()->route('suppliers.index')->with($notification);
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(Request $request)
    {
        Supplier::find($request->product_id)->delete();
        $notification = notify("Supplier Delete Successfully");
        return redirect()->route('supplier.index')->with($notification);
    }
}
