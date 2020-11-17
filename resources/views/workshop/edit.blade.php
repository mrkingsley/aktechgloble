@extends('layouts.db')


@section('main')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Payment</h3>
                </div><!-- /.box-header -->
                <div class="box-body">



                <form class="form-horizontal" action="{{route('workshop.update', $workshop->id)}}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group {{ $errors->has('name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Name </label>

                        <div class="col-sm-7">
                            <input type="text" name="name" class="form-control" value="{{ old('name') ? old('name') : $workshop->name }}" placeholder="Name">
                            {!! $errors->has('name')? '<p class="help-block"> '.$errors->first('name').' </p>':'' !!}
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('hardware')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">hardware</label>

                        <div class="col-sm-7">
                            <input type="number" name="hardware" class="form-control" value="{{ old('hardware')  ? old('hardware') : $workshop->hardware }}" placeholder="  Enter amount e.g 08012...">
                            {!! $errors->has('hardware')? '<p class="help-block"> '.$errors->first('hardware').' </p>':'' !!}
                        </div>
                    </div>
                   

                    <div class="form-group {{ $errors->has('software')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Software</label>
                        <div class="col-sm-7">
                            <textarea type="text" name="software" class="form-control" value="{{ old('software')  ? old('software') : $workshop->software}}" placeholder="Enter amount"></textarea>
                            {!! $errors->has('remark')? '<p class="help-block"> '.$errors->first('remark').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('remark')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Remark</label>
                        <div class="col-sm-7">
                            <textarea type="text" name="remark" class="form-control" value="{{ old('remark')  ? old('remark') : $workshop->remark}}" placeholder="enter your description......"></textarea>
                            {!! $errors->has('remark')? '<p class="help-block"> '.$errors->first('remark').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-square-o"></i> Submit</button>
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