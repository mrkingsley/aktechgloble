@extends('layouts.db')


@section('main')
<section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header box-header-primary">
                  <div class="row">
                  <div class="col-xs-12">
                  </div>
                  </div>
                  <form action="{{ route('products.index') }}"  method="get">
                        <div class="row">
                        <div class="box-header with-border">
                        <h4 class="box-title">Stocks List</h4></div>
                            <div class="col-sm-7"><input type="text" name="search"
                                    class="form-control form-control-sm col-sm-10 float-right"
                                    placeholder="Search Product..." onblur="this.form.submit()"></div>
                            <div class="col-sm-2"><a href="{{ url('/products/create')}}"
                                    class="btn btn-primary btn-sm float-left btn-block">Add Stocks</a></div>
                        </div>
                    </form>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered " style="font-size:14px" id="order_table" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product Name</th>
                                <th>Model</th>
                                <th>Category</th>
                                <th>Unite Price</th>
                                <th>Unite purchase Price</th>
                                <th>Qty</th>
                                <th>Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $index=>$product)
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$product->name,6 }}</td>
                                <td>{{$product->model }}</td>
                                <td>{{$product->category }}</td>
                                <td><span>&#8358;</span>{{$product->price }}</td>
                                <td><span>&#8358;</span>{{$product->sales_price }}</td>
                                <td>{{$product->qty }}</td>
                                <td>{{$product->created_at->format('F d, Y')}}</td>
                    </td>
                        <td>

                        <a href="{{ route('products.edit', $product->id) }}"
                                        class="btn btn-primary btn-block btn-sm">Details<i class="fa fa-pencil"></i> </a>


                                <form onsubmit="return confirm('are you sure you want to delect this user')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('products.destroy', $product->id ) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn "><i class="fa fa-trash-o"></i></button>
                        </form>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import  Data</button>
                <a class="btn btn-warning" href="{{ route('export') }}">Export Product Data</a>
            </form>

                </div><!-- /.box-body -->


            </div><!-- /.box -->



        </div> <!-- /.col -->
    </div>
    <!-- /.row -->


</section><!-- /.content -->



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
