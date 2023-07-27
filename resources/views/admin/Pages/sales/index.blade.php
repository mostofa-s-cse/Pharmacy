@extends('admin.layouts.app')
@section('title','Sales')
@section('content')
<div class="content container-fluid">
  
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Sales</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addSalesModal"><i
                                    class="fa fa-plus"></i> Add Sales</a>
                        </div>
                    </div>
                </div>
                @if(!empty($notification))
                                      @foreach ($notification as $item)
                                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{item}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                      @endforeach
                                    @endif
                        <div class="row">
                            <div class="col-md-12">
                            
                              <!--  Sales -->
                              <div class="card">
                                  <div class="table-responsive">
                                      <div class="card-body">
                                              <table id="outstock-product" class=" table table-hover table-center mb-0">
                                                  <thead>
                                                      <tr>
                                                      <th>Medicine Name</th>
                                                      <th>Quantity</th>
                                                      <th>Total Price</th>
                                                      <th>Date</th>
                                                      <th class="action-btn">Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                   
		            <!-- / sales -->
                    </div>
                </div>
				</div>
            </div>
            
            </div>
            <div id="addSalesModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Sales</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
						 <!-- Create Sale -->
             <form method="POST" action="{{route('sales.store')}}">
					@csrf
					<div class="row form-row">
						<div class="col-12">
							<div class="form-group">
								<label>Product <span class="text-danger">*</span></label>
								<select class="select2 form-select form-control" name="product">
                <option disabled selected > Select Product</option>
									@foreach ($products as $product)
										@if (!empty($product->purchase))
											@if (!($product->purchase->quantity <= 0))
												<option value="{{$product->id}}">{{$product->purchase->product}}</option>
											@endif
										@endif
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-12">
							<div class="form-group">
								<label>Quantity</label>
								<input type="number" value="1" class="form-control" name="quantity">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
				</form>
                <!--/ Create Sale -->
				       </div>
                    </div>
                </div>
            </div>

            <!-- add end -->

            <div id="editSalesModal" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Sales</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
						<form action="#" method="POST" id="edit_Sales_form" enctype="multipart/form-data">
            @csrf
            @method("POST")
          <input type="hidden" name="id" id="id" value="id">
					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Sales <span class="text-danger">*</span></label>
								
								</div>
							</div>
						</div>
					</div>
					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Selling Price<span class="text-danger">*</span></label>
									<input class="form-control" type="text" id="price" name="price">
								</div>
							</div>
	
							<div class="col-lg-6">
								<div class="form-group">
									<label>Discount (%)<span class="text-danger">*</span></label>
									<input class="form-control" type="text" id="discount" name="discount">
								</div>
							</div>
							
						</div>
					</div>
					<div class="service-fields mb-3">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Descriptions <span class="text-danger">*</span></label>
									<textarea class="form-control service-desc" id="description" name="description"></textarea>
								</div>
							</div>
							
						</div>
					</div>		
				
				<div class="submit-section">
					<button class="btn btn-primary submit-btn" id="edit_Sales_btn" type="submit" name="form_submit" value="submit">Submit</button>
				</div>
			</form>
                        </div>
                    </div>
                </div>
            </div>

@endsection
@section('script')
<script>
	$(function() 
	{
    $(document).ready(function() {
        var table = $('#outstock-product').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('sales.index')}}",
            columns: [
              {data: 'product', name: 'product'},
                {data: 'quantity', name: 'quantity'},
                {data: 'total_price', name: 'total_price'},
				        {data: 'date', name: 'date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });

	});
</script> 
@endsection