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
                
                <!-- Outstock Products -->
                    <div class="card">
                    <div class="table-responsive">
                        <div class="card-body">
                                <table id="outstock-product" class=" table table-hover table-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Brand Name</th>
                                            <th>Category</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Expire</th>
                                            <th class="action-btn">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /Outstock Products-->
                            </div>
                        </div>
                </div>
            </div>
            </div>
          


@endsection
@section('script')
<script>
	 $(document).ready(function() {
        var table = $('#outstock-product').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('product.outstock')}}",
            columns: [
                {data: 'product', name: 'product'},
                {data: 'category', name: 'category'},
                {data: 'cost_price', name: 'cost_price'},
                {data: 'quantity', name: 'quantity'},
				{data: 'expiry_date', name: 'expiry_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
</script> 
@endsection