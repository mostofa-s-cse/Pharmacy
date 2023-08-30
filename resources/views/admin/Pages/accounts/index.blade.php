@extends('admin.layouts.app')
@section('title','Accounts')
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Accounts</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Accounts</li>
                    </ul>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <!-- account details -->
                <div class="card">
                    <div class="table-responsive">
                        <div class="card-body">
                            <table  class="table data-table table-striped table-sm text-center align-middle">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Account Head</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                    </tr>
                                  </thead>
                                  <tbody class="" >
                                    @php
                                     $i = 0;
                                   @endphp
                                   @foreach ($accounts as $balance)
                                       <tr>
                                        <td class="text-wrap">{{ ++$i }}</td>
                                        <td class="text-wrap">{{ $balance->account_head }}</td>
                                        <td class="text-wrap">{{ $balance->type }}</td>
                                        <td class="text-wrap">{{ $balance->amount }}</td>
                                       </tr>
                                   @endforeach
                                    
                                </tbody>
                                
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

 </div>

@endsection
@section('script')
    <script>
        
    </script>
@endsection
