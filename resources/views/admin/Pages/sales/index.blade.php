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
                    <!-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addSalesModal"><i
                            class="fa fa-plus"></i> Add Sales</a> -->
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#addCustomerModal"><i
                            class="fa fa-plus"></i> Add Customer</a>
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
            <div class="col-md-6">

                <!-- products -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_product">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>

                </div>
                <!-- /products-->
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="custom_field1">Select customers</label>
                            <input name="customer_id" type="text" list="custom_field1_datalist" class="form-control"
                                   placeholder="Search customers">
                            <datalist id="custom_field1_datalist">
                                @foreach ($customers as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </datalist>
                            <span id="error" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-white" id="addTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="col-sm-2">Item</th>
                            <th class="col-md-6">Description</th>
                            <th>Unit Cost</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="tbodyone">
                        <tr>
                            <td>1</td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" readonly type="text">
                            </td>
                            <td><a href="javascript:void(0)" class="text-success font-18"
                                   id="addProduct" title="Add"><i class="fa fa-plus"></i></a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" type="text">
                            </td>
                            <td>
                                <input class="form-control" readonly type="text">
                            </td>
                            <td><a href="javascript:void(0)" class="text-danger font-18 remove"
                                   title="Remove"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
            </div>
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
                                        <option disabled selected> Select Product</option>
                                        @foreach ($products as $product)
                                            @if (!empty($product->purchase))
                                                @if (!($product->purchase->quantity <= 0))
                                                    <option
                                                        value="{{$product->id}}">{{$product->purchase->product}}</option>
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
                    <!-- Edit Sale -->
                    <form method="post" enctype="multipart/form-data" id="edit_sales_form" autocomplete="off">
                        @csrf
                        @method("POST")
                        <input type="hidden" name="id" id="id" value="id">
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Product <span class="text-danger">*</span></label>
                                    <select class="select2 form-select form-control" id="product_id" name="product">
                                        @foreach ($products as $product)
                                            @if (!empty($product->purchase))
                                                @if (!($product->purchase->quantity <= 0))
                                                    <option
                                                        value="{{$product->id}}">{{$product->purchase->product}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" class="form-control edit_quantity" id="quantity"
                                           name="quantity">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="edit_sales_btn" type="submit">Submit</button>
                        </div>
                    </form>
                    <!--/ Edit Sale -->
                </div>
            </div>
        </div>
    </div>
    <!-- add customer modal -->
    <div id="addCustomerModal" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="POST" id="add_Customer_form" enctype="multipart/form-data">
                        @csrf
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" required="true">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" id="email" required="true">
                                </div>
                            </div>
                        </div>

                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Phone<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="phone" required="true">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Due</label>
                                        <input type="text" name="due" class="form-control" required="true">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn" id="add_Customer_btn" type="submit"
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
        $(function () {

            // fetch all product ajax request
            fetchAllProduct();

            function fetchAllProduct() {
                $.ajax({
                    url: '{{ route('sales.fetchAll') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_product").html(response);
                        $("table").DataTable({});
                    }
                });
            }

        });
    </script>
@endsection
