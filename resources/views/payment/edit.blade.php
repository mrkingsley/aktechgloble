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



                <form class="form-horizontal" action="{{route('payment.update', $payment->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                        <div class="form-group {{ $errors->has('supplier_name')? 'has-error' : '' }}">
                            <label class="control-label col-sm-3">Supplier Name</label>

                            <div class="col-sm-7">
                            <select class="form-control" placeholder="Select Product, " name="supplier">
                            <option value="{{ old('supplier') ? old('supplier') : $payment->supplier}}">{{ old('supplier') ? old('supplier') : $payment->supplier}}</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{$supplier->supplier_name}}">{{$supplier->supplier_name}}</option>
                                        @endforeach
                                    </select>

                            </div>
                        </div>

                    <div class="form-group {{ $errors->has('purchase_amount')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Purchase Amount:</label>

                        <div class="col-sm-7">
                            <input type="number" name="purchase_amount" class="form-control" value="{{ old('purchase_amount') ? ('purchase_amount') : $payment->purchase_amount }}" placeholder="Enter Purchase amount">
                            {!! $errors->has('purchase_amount')? '<p class="help-block"> '.$errors->first('purchase_amount').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('payment')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Payment:</label>

                        <div class="col-sm-7">
                            <input type="number" name="payment" class="form-control" value="{{ old('payment') ? old('payment') : $payment->payment}}" placeholder="Enter amount paid">
                            {!! $errors->has('payment')? '<p class="help-block"> '.$errors->first('payment').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('method')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Model:</label>
                        <div class="col-sm-7">
                            <select class="form-control show-tick" name="method" id="type">
                                <option value="{{ old('method') ? old('method') : $payment->method}}" disabled selected>{{ old('method') ? old('method') : $payment->method}}</option>
                                <option value="Cash">Cash</option>
                                <option value="Bank">Bank</option>
                                <option value="Transfer">transfer</option>
                                <option value="ATM">ATM</option>
                            </select> {!! $errors->has('method')? '<p class="help-block"> '.$errors->first('method').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-7 col-sm-offset-3">
                            <button type="submit" name="submit" class="btn btn-primary" required="required"><i class="fa fa-plus-square-o"></i> Update</button>
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
