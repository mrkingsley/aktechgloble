@extends('layouts.db')


@section('main')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Customer </h3>
                </div><!-- /.box-header -->
                <div class="box-body">



                <form class="form-horizontal" action="{{route('client.store')}}" enctype="multipart/form-data" method="post">
                        @csrf


                    <div class="form-group {{ $errors->has('customer_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Name</label>

                        <div class="col-sm-7">
                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" placeholder="Customer Name">
                            {!! $errors->has('customer_name')? '<p class="help-block"> '.$errors->first(' customer_name').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('phone')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">phone</label>

                        <div class="col-sm-7">
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="Phone number">
                            {!! $errors->has('phone')? '<p class="help-block"> '.$errors->first('phone').' </p>':'' !!}
                        </div>
                    </div>



                    <div class="form-group {{ $errors->has('customer_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Address</label>

                        <div class="col-sm-7">
                            <input type="text" name="remark" class="form-control" value="{{ old('remark') }}" placeholder=" Customer Address">
                            {!! $errors->has('remark')? '<p class="help-block"> '.$errors->first('remark').' </p>':'' !!}
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Submit</button>
                        </div>
                    </div>

                    </form>


                </div><!-- /.box-body -->


            </div><!-- /.box -->



        </div> <!-- /.col -->
    </div>
    </div>
    <!-- /.row -->


</section><!-- /.content -->


@endsection
