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
                  <form action="{{ route('client.index') }}"  method="get">
                    <div class="row">
                    <div class="box-header with-border">
                    <h4 class="box-title"> Customer List</h4></div>
                        <div class="col-sm-7"><input type="text" name="search"
                                class="form-control form-control-sm col-sm-10 float-right"
                                placeholder="Search Transaction..." onblur="this.form.submit()"></div>
                        <div class="col-sm-2"><a href="{{ url('/client/create')}}"
                                class="btn btn-primary btn-sm float-left btn-block">Add</a></div>
                    </div>
                </form>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered" style="font-size:14px" id="order_table" >
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($client as $index=>$client)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $client->customer_name }}</td>
                        <td>{{ $client->phone}}</td>
                        <td>{{ $client->remark}}</td>
                    </td>
                        <td>
                        @can('client-edit')
                            <a class="btn " data-toggle="tooltip"data-placement="top"  href="{{ route('client.edit',$client->id) }}"><i class="fa fa-pencil"></i> </a>
                            @endcan

                            @can('client-delete')
                                <form onsubmit="return confirm('are you sure you want to delect this user')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('client.destroy', $client->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn "><i class="fa fa-trash-o"></i></button>
                        </form>
                        @endcan

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
