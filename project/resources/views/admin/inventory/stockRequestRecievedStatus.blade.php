@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('Inventory') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Inventory') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                        </li>
                        <li>
                            <a href="{{ route('admin-inventory-index') }}">{{ __('Inventory') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mr-table allproduct">
                        @include('includes.admin.form-success')
                        <div class="table-responsiv">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show session-message" role="alert">
                                    <strong>{{ session('success') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('warning'))
                                <div class="alert alert-danger alert-dismissible fade show session-message" role="alert">
                                    <strong>{{ session('warning') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form id="" class="mt-5" action="{{route('inventory-stock-request-status-change',$inventoryRequests->id)}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">

                                    <div class="col-lg-3">
                                        <div class="left-area">
                                            <h4 class="heading ">{{ __('Status') }}* </h4>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <select name="status" id="" class="input-field" required>
                                            <option value="">Select</option>
                                            <option value="2" >Accept</option>
                                            <option value="3" >Cancel</option>
                                            <option value="5" >Refund</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="page" value="1">
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="left-area">

                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <button class="add-btn" type="submit">{{ __('Request') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection



@section('scripts')



@endsection