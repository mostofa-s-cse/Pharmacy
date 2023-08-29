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
                <!-- products -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body" id="show_all_Sales">
                            <h3 class="text-center text-secondary my-5">Loading...</h3>
                        </div>
                    </div>

                </div>
                <!-- /products-->
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
            // var table = $('#sales-table').DataTable({
            //     "responsive": false,
            //     "lengthChange": true,
            //     "autoWidth": false,
            //     "buttons": ["csv", "excel", "pdf", "print"]
            // }).buttons().container().appendTo('#purchase-table_wrapper .col-md-6:eq(0)');
            // fetch all product ajax request
            fetchAllProduct();

            function fetchAllProduct() {
                $.ajax({
                    url: '{{ route('sales.fetchAllSales') }}',
                    method: 'get',
                    success: function (response) {
                        $("#show_all_Sales").html(response);
                        $("table").DataTable({});
                    }
                });
            }
    </script>
@endsection
