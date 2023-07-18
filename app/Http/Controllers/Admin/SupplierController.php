<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    // set index page view
    public function index()
    {

        // if($request->ajax()){
        //     $supplier = Supplier::get();
        //     return DataTables::of($supplier)
        //         ->addIndexColumn()
        //         ->addColumn('action', function ($row) {
        //             $editbtn = '<a href="'.route("supplier.update", $row->id).'" class="editbtn"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
        //             $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('supplier.delete', $row->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
        //             $btn = $editbtn.' '.$deletebtn;
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
        return view('admin.pages.supplier.index');
        // return view('admin.pages.supplier.index');
    }
  
    // handle fetch all eamployees ajax request
	public function fetchAll() {
		$suppliers = Supplier::all();
		$output = '';
		if ($suppliers->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>Product</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Company</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($suppliers as $supplier) {
				$output .= '<tr>
                <td>' . $supplier->product . '</td>
                <td>' . $supplier->name . '</td>
                <td>' . $supplier->email . '</td>
                <td>' . $supplier->phone . '</td>
                <td>' . $supplier->address . '</td>
                <td>' . $supplier->company . '</td>
                <td>
                  <a href="#" id="' . $supplier->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editSupplierModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>

                  <a href="#" id="' . $supplier->id . '" class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
		}
	}



    // handle insert a new Supplier ajax request
	public function store(Request $request) {
		$supplierData = [
            'product' => $request->product, 
            'name' => $request->name, 
            'email' => $request->email, 
            'phone' => $request->phone, 
            'address' => $request->address,
            'company' => $request->company, 
            'comment' => $request->comment
        ];
		Supplier::create($supplierData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle edit an Supplier ajax request
	public function edit(Request $request) {
		$id = $request->id;
		$emp = Supplier::find($id);
		return response()->json($emp);
	}

	// handle update an Supplier ajax request
	public function update(Request $request) {
		$fileName = '';
		$emp = Supplier::find($request->emp_id);
		if ($request->hasFile('avatar')) {
			$file = $request->file('avatar');
			$fileName = time() . '.' . $file->getClientOriginalExtension();
			$file->storeAs('public/images', $fileName);
			if ($emp->avatar) {
				Storage::delete('public/images/' . $emp->avatar);
			}
		} else {
			$fileName = $request->emp_avatar;
		}

		$empData = ['first_name' => $request->fname, 'last_name' => $request->lname, 'email' => $request->email, 'phone' => $request->phone, 'post' => $request->post, 'avatar' => $fileName];

		$emp->update($empData);
		return response()->json([
			'status' => 200,
		]);
	}

	// handle delete an Supplier ajax request
	public function delete(Request $request) {
		$id = $request->id;
		Supplier::destroy($id);
	}
}
