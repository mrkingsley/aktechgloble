@extends('layouts.db')

@section('main')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Supplier</h3>
                </div><!-- /.box-header -->
                <div class="box-body">



                <form class="form-horizontal" action="{{route('supplier.store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                    <div class="form-group {{ $errors->has('supplier_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Name</label>

                        <div class="col-sm-7">
                            <input type="text" name="supplier_name" class="form-control" value="{{ old('supplier_name') }}" placeholder="supplier name">
                            {!! $errors->has('supplier name')? '<p class="help-block"> '.$errors->first('supplier name').' </p>':'' !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">phone</label>

                        <div class="col-sm-7">
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="  Mobile number e.g 08012...">
                            {!! $errors->has('phone')? '<p class="help-block"> '.$errors->first('phone').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('company')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Deals On</label>
                        <div class="col-sm-7">
                            <input type="text" name="company" class="form-control" value="{{ old('company') }}" placeholder="supplier products e.g touchpad,  downpanel, ">
                            {!! $errors->has('email')? '<p class="help-block"> '.$errors->first('email').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Add Supplier</button>
                        </div>
                    </div>

                    </form>
                </div><!-- /.box-body -->


            </div><!-- /.box -->



        </div> <!-- /.col -->
    </div>
    <!-- /.row -->


</section><!-- /.content -->


@endsection
