@extends('layouts.default-sidebar')
@section('content')
<div class="col-sm-9 col-lg-10">
    <div class="container">
        <h1>Add Outlets</h1>
        <div class="card">
            <div class="card-body">
                <form action="/setting/outlets/addoutletstore" method="post">
                    {{ csrf_field() }}
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <li>{{ $error }}</li>
                        @endforeach
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Outlet Name <span style="color: #F00">*</span></label>
                                <input type="text" name="name_outlet" class="form-control" maxlength="499" autofocus
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Number <span style="color: #F00">*</span></label>
                                <input type="text" name="contact_number" class="form-control" maxlength="30" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address <span style="color: #F00">*</span></label>
                                <textarea name="address_outlet" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Header <span style="color: #F00">*</span></label>
                                    <textarea name="receipt_header" class="ckeditor" id="ckedtor" cols="60"></textarea>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md">
                            <div class="form-group">
                                <label>Receipt Footer <span style="color: #F00">*</span></label>
                                <textarea name="receipt_footer" class="ckeditor" id="ckedtor" cols="60"></textarea>
                                <input type="text" name="status" value="1" readonly hidden>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" style="width: 100%" value="Add">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="margin-top: 15px;">
            <div class="col-md-2">
                <a href="{{ url ('setting/outlets')}}">
                    <button class="btn btn-secondary" style="width: 60%"><i class="fa fa-chevron-left"></i> Back
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.12.1/basic/ckeditor.js"></script>
</section>
@stop
