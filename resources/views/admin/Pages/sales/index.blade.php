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
                    </a>
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
            <div class="col-md-5">

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
            <div class="col-md-7">
                <div class="card">
                <div class="table-responsive">
                    <div class="card-body">
                        <h4 class="text-center">Create Bill</h4>
                        <hr/>
                        <form action="" method="POST" id="add_sale_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group shadow-sm p-3 mb-5 bg-white rounded">
                            <label for="custom_field1">Select customers</label>
                            <input type="text" list="custom_field1_datalist" class="form-control"
                                   placeholder="Search customers" name="customer_id">
                            <datalist id="custom_field1_datalist">
                                @foreach ($customers as $item)
                                    <option value="{{$item->customer_id}}">{{$item->name}}</option>
                                @endforeach
                            </datalist>
                            <span id="error" class="text-danger"></span>
                        </div>
                        <div class="table-responsive">
                        <table>
                                    <table class="table">
                                        <thead class="shadow-sm p-3 mb-5 bg-white rounded">
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                            <tbody class="input_fields_wrap" id="input_fields_wrap">
                                                    <!-- dynamic fields -->
                                            </tbody>
                                    </table>
                                    
                                </table>
                                <div class="bill-sumary shadow-sm p-3 mb-5 bg-white rounded">
                                    <div class="row mx-3">
                                        <table class="table">
                                        <thead>
                                           
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td>Sub Total :</td>
                                            <td><input type="text" name="sub_total" class="form-control" /></td>
                                            </tr>
                                            <tr>
                                            <td>Discount :</td>
                                            <td><input type="text" name="discount" class="form-control" /></td>
                                            </tr>
                                            <tr>
                                            <td>Total :</td>
                                            <td><input type="text" name="total" class="form-control" /></td>
                                            </tr>
                                            <tr>
                                            <td>Paid By</td>
                                            <td><select class="custom-select form-control" name="paid_by">
                                                <option selected>Select Type</option>
                                                <option value="cash">Cash</option>
                                                <option value="2">Two</option>
                                                <option value="3">Three</option>
                                                </select></td>
                                            </tr>
                                            <tr>
                                            <td>Amount Paid :</td>
                                            <td><input type="text" name="amount_paid" class="form-control" /></td>
                                            </tr>
                                            <tr>
                                            <td>Due/Return :</td>
                                            <td><input type="text" name="due_return" class="form-control" /></td>
                                            </tr>
                                        </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div>
                                <div class="submit-section" style="margin-top: 15px;margin-bottom: 10px;">
                                    <button type="submit" id="add_sale_btn" class="btn btn-primary btn-block">Submit</button>
                                </div>
                         </form>
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
                                        <label>Customer ID<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="customer_id" required="true">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" required="true">
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
                                        <label>Email</label>
                                        <input class="form-control" type="text" name="email" id="email" required="true">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="service-fields mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
        // tablebtn


       // dynamic add fields..........................................

$(document).ready(function () {
            $('.select2').select2();
        });
        // tablebtn

        var i=0;
        $(document).on('click', '#tablebtn .add_field_button', function(e) {
            // $("#id").val(e.currentTarget.id);
            console.log(e.currentTarget.id);
            console.log(e.currentTarget.getAttribute('name'));
            ++i;
            $('#input_fields_wrap').append(`
            <tr id="addfields"><td><input type="text" list="custom_field2_datalist" class="form-control" placeholder="Search Product" name="inputs[`+i+`][product_name]"><datalist id="custom_field2_datalist">@foreach ($products as $product)@if (!empty($product->purchase))  @if (!($product->purchase->quantity <= 0))<option value="{{$product->id}}">{{$product->purchase->product}}</option>@endif @endif @endforeach</datalist><span id="error" class="text-danger"></span></td><td><input type="text" class="form-control" name="inputs[`+i+`][quantity]" placeholder="Quantity"></td><td><input type="text" class="form-control" name="inputs[`+i+`][price]" placeholder="Rate"></td><td><input type="text" class="form-control" name="inputs[`+i+`][total_price]" placeholder="Price"></td><td><a href="javascript:void(0)" class="btn btn-danger text-white font-18 remove_field" id="rm" title="Remove"><i class="fa fa-trash"></i></a></a></td></tr>
            `);

        });
             $(document).on("click", ".remove_field", function () { //user click on remove text
               $(this).parents('tr').remove();
            });
    


        $(function () {
            // add new Customer ajax request
            $("#add_Customer_form").submit(function (e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_Customer_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('customer.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Customer Added Successfully!',
                                'success'
                            )
                            location.reload();
                        }
                        $("#add_Customer_btn").text('Add Customer');
                        $("#add_Customer_form")[0].reset();
                        $("#addCustomerModal").modal('hide');
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Add Customer fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
            });

             // add new sales ajax request
             $("#add_sale_form").submit(function (e) {
                e.preventDefault();
                const fd = new FormData(this);
                $("#add_sale_btn").text('Adding...');
                $.ajax({
                    url: '{{ route('sales.store') }}',
                    method: 'post',
                    data: fd,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Added!',
                                'Sales Added Successfully!',
                                'success'
                            )
                            location.reload();
                        }
                        $("#add_sale_btn").text('Add Sale');
                        $("#add_sale_form")[0].reset();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        // alert(xhr.status);
                        Swal.fire(
                            'Sales Add fails!',
                            thrownError,
                            'error'
                        )
                        // alert(thrownError);
                    }
                })
            });

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
