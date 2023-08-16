@extends('admin.layouts.app')
@section('title','Inventories')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Inventory</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Inventory</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addInventoryModal"><i
                            class="fa fa-plus"></i> Add Inventory</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- Customers -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body">
                            <table  class="table table-striped table-sm text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Product Name</th>
                                        <th>Shope Name</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody >
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($inventory as $item)
                                        <tr> 
                                            <td>{{ ++$i }}</td>
                                            <td class="text-wrap">{{ $item->product_name }}</td>
                                            <td class="text-wrap">{{ $item->shope_name }}</td>
                                            <td class="text-wrap">{{ $item->quantity }}</td>
                                            <td class="text-wrap">{{ $item->amount }}</td>
                                            <td class="text-wrap">{{ $item->purchase_date }}</td>
                                            
                        
                        
                                            <td class="d-flex">
                                                <a href={{route('inventories.edit',$item->id)}}  class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
                                                <a href={{route('inventories.delete',$item->id)}}  class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    <!-- /Customers-->
                </div>
            </div>
        </div>
    </div>

    </div>
    <div id="addInventoryModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Inventory</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action={{ route('inventories.store') }} method="POST" id="add_inventory_form" enctype="multipart/form-data">
				@csrf
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Purchase Name:<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="product_name" required="true">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Shope Name:</label>
							<input class="form-control" type="text" name="shope_name" id="shopne_name" required="true">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Quantity:<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="quantity" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                        <div class="form-group">
								<label>Amount:</label>
								<input type="text" name="amount" class="form-control" required="true">
							</div>
						</div>
					</div>
				</div>			
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-12">
                        <div class="form-group">
								<label>Purchase Date:</label>
								<input type="date" name="purchase_date" class="form-control" required="true">
							</div>
						</div>
					</div>
				</div>
				
				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="add_inventory_btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
			</form>
                </div>
            </div>
        </div>
    </div>



<div class="">
    {{-- <table  class="table table-striped table-sm text-center align-middle">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Product Name</th>
                <th>Shope Name</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Purchase Date</th>
                <th>Action</th>
            </tr>
          </thead>
          <tbody >
            @php
                $i = 0;
            @endphp
            @foreach ($inventory as $item)
                <tr> 
                    <td>{{ ++$i }}</td>
                    <td class="text-wrap">{{ $item->product_name }}</td>
                    <td class="text-wrap">{{ $item->shope_name }}</td>
                    <td class="text-wrap">{{ $item->quantity }}</td>
                    <td class="text-wrap">{{ $item->amount }}</td>
                    <td class="text-wrap">{{ $item->purchase_date }}</td>
                    


                    <td class="d-flex">
                        <a href="#"  class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editCategoryModal"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
                        <a href="#"  class="text-danger mx-1 deleteIcon"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table> --}}
</div>

    <!-- add end -->

    <div id="editCategoryModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Inventory</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  method="POST" id="inventory_form" enctype="multipart/form-data" >
                        @csrf
                        @method('PUT')
                        
                        <div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Purchase Name:<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="name" id="name" required="true">
							</div>
						</div>
						<div class="col-lg-6">
							<label>Shope Name:</label>
							<input class="form-control" type="text" name="shope_name" id="shope_name" required="true">
						</div>
					</div>
				</div>

				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>Quantity:<span class="text-danger">*</span></label>
								<input class="form-control" type="text" name="quantity" id="quantity" required="true">
							</div>
						</div>
						<div class="col-lg-6">
                        <div class="form-group">
								<label>Amount</label>
								<input type="text" name="amount" class="amount" id="amount" required="true">
							</div>
						</div>
					</div>
				</div>			
				<div class="service-fields mb-3">
					<div class="row">
						<div class="col-12">
                        <div class="form-group">
								<label>Purchase Date</label>
								<input type="date" name="purchase_date" class="purchase_date" id="purchase_date" required="true">
							</div>
						</div>
					</div>
				</div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_Customer_btn" type="submit"
                                    name="form_submit" value="submit">Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
       
            // add new Customer ajax request
          

            // edit Customer ajax request
         
    </script>
@endsection
