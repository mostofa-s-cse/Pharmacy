@extends('admin.layouts.app')
@section('title','Products-Outstock')
@section('content')
<div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Products-Outstock</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Product-Outstock</li>
                            </ul>
                        </div>
                    </div>
                </div>
            <div class="row">
                <div class="col-md-12">
                
                    <!-- products -->
                    <div class="card">
                  <div class="table-responsive">
                  <div class="card-body" id="show_all_product">
                      <h3 class="text-center text-secondary my-5">Loading...</h3>
                      </div>
                            </div>
                            <!-- /products-->
                            </div>
                        </div>
                </div>
            </div>
            </div>
          


@endsection
@section('script')
<script>
	$(function() 
	{
		// fetch all product ajax request
		fetchAllOutstockProduct();
		function fetchAllOutstockProduct() {
		$.ajax({
			url: '{{ route('product.Alloutstock') }}',
			method: 'get',
			success: function(response) {
			$("#show_all_product").html(response);
			$("table").DataTable({
				order: [0, 'desc']
			});
			}
		});
		}
	});
</script> 
@endsection