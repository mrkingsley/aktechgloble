@extends('layouts.db')


@section('main')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Customer Detail</h3>
                </div><!-- /.box-header -->
                <div class="box-body">



                <form class="form-horizontal" action="{{route('client.update', $client->id)}}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group {{ $errors->has('customer_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Name </label>

                        <div class="col-sm-7">
                            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') ? old('customer_name') : $client->customer_name }}" placeholder="Customer Name">
                            {!! $errors->has('customer_name')? '<p class="help-block"> '.$errors->first('customer_name').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('phone')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">phone</label>

                        <div class="col-sm-7">
                            <input type="text" name="phone" class="form-control" value="{{ old('phone')  ? old('phone') : $client->phone }}" placeholder="  Mobile number e.g 08012...">
                            {!! $errors->has('phone')? '<p class="help-block"> '.$errors->first('phone').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('company')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Remark</label>
                        <div class="col-sm-7">
                            <input type="text" name="remark" class="form-control" value="{{ old('remark')  ? old('remark') : $client->remark}}" placeholder=" Customer Address">
                            {!! $errors->has('remark')? '<p class="help-block"> '.$errors->first('remark').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Update</button>
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
