@extends('layouts.db')


@section('main')

        <!-- Content Header (Page header) -->

<!-- Main content -->
<section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header box-header-primary">
                  <div class="row">
                  <div class="col-xs-12">
                  </div>
                  </div>
                  <form action="{{ route('supplier.index') }}"  method="get">
                    <div class="row">
                    <div class="box-header with-border">
                    <h4 class="box-title"> Supplier List</h4></div>
                        <div class="col-sm-7"><input type="text" name="search"
                                class="form-control form-control-sm col-sm-10 float-right"
                                placeholder="Global Search..." onblur="this.form.submit()"></div>
                        <div class="col-sm-2"><a href="{{ url('/supplier/create')}}"
                                class="btn btn-primary btn-sm float-left btn-block">Add</a></div>
                    </div>
                </form>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered " style="font-size:14px" id="order_table" >
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Supplier Name</th>
                            <th>Phone No:</th>
                            <th>Deals On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($supplier as $index=>$supplier)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $supplier->supplier_name }}</td>
                        <td>{{ $supplier->phone}}</td>
                        <td>{{ $supplier->company}}</td>
                        <td>
                            <a class="btn " data-toggle="tooltip"data-placement="top"  href="{{ route('supplier.edit',$supplier->id) }}"><i class="fa fa-pencil"></i> </a>


                                <form onsubmit="return confirm('are you sure you want to delect this user')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('supplier.destroy', $supplier->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn "><i class="fa fa-trash-o"></i></button>
                        </form>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

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
