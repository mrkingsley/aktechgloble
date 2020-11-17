@extends('layouts.db')

@section('main')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Purchases</h3>
                </div><!-- /.box-header -->
                <div class="box-body">



                <form class="form-horizontal" action="{{route('purchase.update', $purchase->id)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group {{ $errors->has('supplier_name')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Supplier:</label>

                        <div class="col-sm-7">
                            <select class="form-control" placeholder="Select Product, " name="supplier_name">
                            <option value="{{ old('supplier_name') ? old('supplier_name') : $purchase->supplier_name}}">{{ old('supplier_name') ? old('supplier_name') : $purchase->supplier_name}}</option>
                                        @foreach($suppliers as $supplier)
                                            <option value="{{ $supplier->supplier_name}}">{{ old('supplier_name') ? old('supplier_name') : $supplier->supplier_name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    <div class="form-group {{ $errors->has('product')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Product:</label>

                        <div class="col-sm-7">
                            <select class="form-control" placeholder="Select Product, " name="product">
                            <option value="{{ old('product') ? old('product') : $purchase->product}}">{{ old('product') ? old('product') : $purchase->product}}</option>
                                        @foreach($products as $product)
                                            <option value="{{$product->name}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>

                    <div class="form-group {{ $errors->has('qty')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Qty:</label>

                        <div class="col-sm-7">
                            <input type="text" name="qty" class="form-control" value="{{ old('qty') ? old('qty') : $purchase->qty}}" placeholder="Enter product quantity">
                            {!! $errors->has('qty')? '<p class="help-block"> '.$errors->first('qty').' </p>':'' !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('purchase_price')? 'has-error' : '' }}">
                        <label class="control-label col-sm-3">Price:</label>

                        <div class="col-sm-7">
                            <input type="text" name="purchase_price" class="form-control" value="{{ old('purchase_price') ? ('purchase_price') :  $purchase->purchase_price }}" placeholder="Enter Unit Price">
                            {!! $errors->has('purchase_price')? '<p class="help-block"> '.$errors->first('purchase_price').' </p>':'' !!}
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
