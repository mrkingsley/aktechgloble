@extends('layouts.db')

@section('main')
<div class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                <h4 class="box-title">Edit And View Product history</h4>
                    <div class="box-body">
                </div>
                <div class="box-body">
                    @if(Session::has('error'))
                    @include('layouts.flash-error',[ 'message'=> Session('error') ])
                    @endif
                    @if(Session::has('success'))
                    @include('layouts.flash-success',[ 'message'=> Session('success') ])
                    @endif
                    <form action="{{url('/products')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="qty" value="{{ $product->qty }}">
                        <div class="form-group">
                            <label for="product">Product Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $product->name) }}">
                            @include('layouts.error', ['name' => 'name'])
                        </div>
                        <div class="form-group">
                            <label for="product">Model</label>
                            <input type="text" class="form-control" name="model"
                                value="{{ old('name', $product->model) }}">
                            @include('layouts.error', ['name' => 'model'])
                        </div>
                        <div class="form-group">
                            <label for="product">Category</label>
                            <input type="text" class="form-control" name="category"
                                value="{{ old('name', $product->category) }}">
                            @include('layouts.error', ['name' => 'category'])
                        </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price"
                                        value="{{ old('price' , $product->price) }}">
                                    @include('layouts.error', ['name' => 'price'])
                                </div>



                                <div class="form-group">
                                    <label for="qty">Qty</label>
                                    <input type="number" class="form-control" value="{{ old('qty', $product->qty) }}"
                                        disabled>
                                </div>
                                <div class="form-group">
                                    <label for="addQty">Add / Reduce Qty </label>
                                    <input type="number" class="form-control" name="addQty" value="{{ old('addQty') }}"
                                        placeholder="Use positive number to increase | negative number to decrease">
                                    @if(Session::has('errorQty'))
                                    <small class="text-danger font-weight-bold">
                                        {{ Session('errorQty') }}
                                    </small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description"
                                class="form-control">{{ old('description', $product->description) }}</textarea>
                            @include('layouts.error', ['name' => 'description'])
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Update Stock</button>
                        </div>
                    </form>
                    <H4>Detailed Information Of This Product</H4>
                    <table class="table table-hover table-striped table-bordered " style="font-size:14px" id="order_table" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Updated By</th>
                                <th>Qty Before</th>
                                <th>Added/Remove Qty </th>
                                <th>Qty</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($history as $index=>$item)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->qtyChange}}</td>
                                <td>{{$item->qty + $item->qtyChange}}</td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>{{$item->tipe}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
@endsection

@section('page-js')
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#order_table').DataTable({order: [],
    scrollX: true,
    });
        } );
    </script>
@endsection


