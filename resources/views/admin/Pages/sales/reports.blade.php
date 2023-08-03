@extends('admin.layouts.app')
@section('title','Sales Report')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Sales Report</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Sales Report</li>
                    </ul>
                </div>
                <div class="col-auto float-end ms-auto">
                    <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#generateReport"><i
                            class="fa fa-plus"></i>Generate Report</a>
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
                <!-- / sales Report -->
            </div>
        </div>
    </div>
    </div>

    </div>
    <!-- Generate Modal -->

    <div id="generateReport" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sales</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- generateReport Sale -->
                    <form method="POST" action="{{route('sales.reports')}}">
                        @csrf
                        @method("POST")
                        <div class="row form-row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>From</label>
                                            <input type="date" name="from_date" class="form-control from_date">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>To</label>
                                            <input type="date" name="to_date" class="form-control to_date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block submit_report">Submit</button>
                    </form>
                    <!--/generateReport  Sale -->
                </div>
            </div>
        </div>
    </div>
    <!-- /Generate Modal -->
@endsection
@section('script')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.jqueryui.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.js"></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.jqueryui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.jqueryui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.flash.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.js"></script>
    <script>
        $(function () {
            //
            $('#sales-table').DataTable({
                dom: 'B',
                buttons: ['print','csv', 'excel','pdf']
            });
        });
    </script>
@endsection
