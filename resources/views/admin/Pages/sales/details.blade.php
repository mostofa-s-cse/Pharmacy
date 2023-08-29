@extends('admin.layouts.app')
@section('title','Sales Details')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sales Details</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales Details</li>
                    </ul>
                </div>
                <!-- <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#generateDetails"><i
                            class="fa fa-plus"></i>Generate Details</a>
                </div> -->
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
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">

                            <table id="sales-table" class="datatable table table-hover table-center mb-0">
                                <thead>
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($sales as $sale)
                                    @if (!(empty($sale->product->purchase)))
                                        <tr>
                                            <td>
                                                @if (!empty($sale->product->purchase->image))
                                                    <span class="avatar avatar-sm mr-2">
                                                    <img class="avatar-img"
                                                         src="{{asset("storage/purchases/".$sale->product->purchase->image)}}"
                                                         alt="image">
                                                    </span>
                                                @endif
                                                {{$sale->product->purchase->product}}
                                            </td>
                                            <td>{{$sale->quantity}}</td>
                                            <td>{{($sale->total_price)}}</td>
                                            <td>{{date_format(date_create($sale->created_at),"d M, Y")}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- / sales Details -->
            </div>
        </div>
    </div>
    </div>

    </div>
    <!-- Generate Modal -->

    
    <!-- /Generate Modal -->
@endsection
@section('script')
    <script>
            var table = $('#sales-table').DataTable({
                "responsive": false,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#purchase-table_wrapper .col-md-6:eq(0)');
    </script>
@endsection
