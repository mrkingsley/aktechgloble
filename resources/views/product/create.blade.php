@extends('layouts.db')

@section('main')
<div class="content">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title font-weight-bold">Add Products</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if(Session::has('error'))
                        @include('layouts.flash-error',[ 'message'=> Session('error') ])
                    @endif
                    <form action="{{url('/products')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label for="product">Product Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @include('layouts.error', ['name' => 'name'])
                        </div>


                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" name="model" value="{{ old('price') }}">
                                    @include('layouts.error', ['name' => 'model'])
                                </div>

                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <input type="text" class="form-control" name="category" value="{{ old('category') }}">
                                    @include('layouts.error', ['name' => 'category'])
                                </div>
                                <div class="form-group">
                                    <label for="price">Price(Saling):</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                                    @include('layouts.error', ['name' => 'price'])
                                </div>

                                <div class="form-group">
                                    <label for="sales_price">Price(Purchase):</label>
                                    <input type="number" class="form-control" name="sales_price" value="{{ old('sales_price') }}">
                                    @include('layouts.error', ['name' => 'sales_price'])
                                </div>


                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="number" class="form-control" name="qty" value="{{ old('qty') }}">
                                    @include('layouts.error', ['name' => 'qty'])
                                </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description"
                                class="form-control">{{ old('description') }}</textarea>
                                @include('layouts.error', ['name' => 'description'])
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Submit Stock</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
