@extends('admin.layouts.app')
@section('title','Create Supplier')
@section('content')

<div class="content container-fluid">
                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Supplier</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Supplier</li>
                            </ul>
                        </div>
                        <div class="col-auto float-end ms-auto">
                            <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_supplier"><i
                                    class="fa fa-plus"></i> Add Supplier</a>
                        </div>
                    </div>
                </div>

                </div>

@endsection