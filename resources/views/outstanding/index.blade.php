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
                  <form action="{{ route('outstanding.index') }}"  method="get">
                    <div class="row">
                    <div class="box-header with-border">
                    <h4 class="box-title"> Outstanding List</h4></div>
                        <div class="col-sm-7"><input type="text" name="search"
                                class="form-control form-control-sm col-sm-10 float-right"
                                placeholder="Global Search..." onblur="this.form.submit()"></div>
                        <div class="col-sm-2"><a href="{{ url('/outstanding/create')}}"
                                class="btn btn-primary btn-sm float-left btn-block">Add</a></div>
                    </div>
                </form>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered " style="font-size:15px"  id="order_table" >
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer</th>
                            <th>Purchase Amount</th>
                            <th>Payment</th>
                            <th>Balance</th>
                            <th>Model</th>
                            <th>Time</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                    @foreach($outstanding as $index=>$outstanding)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $outstanding->client }}</td>
                        <td><span>&#8358;</span>{{ $outstanding->purchase_amount}}</td>
                        <td><span>&#8358;</span>{{ $outstanding->payment}}</td>
                        <td><span>&#8358;</span>{{ $outstanding->purchase_amount - $outstanding->payment }}</td>
                        <td>{{ $outstanding->method  }}</td>
                        <td>{{ $outstanding->created_at->format('F d, Y')}}</td>
                    </td>
                        <td>
                        @can('bank-edit')
                            <a class="btn " data-toggle="tooltip"data-placement="top"  href="{{ route('outstanding.edit',$outstanding->id) }}"><i class="fa fa-pencil"></i> </a> @endcan
                                <form onsubmit="return confirm('are you sure you want to delect this transaction!')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('outstanding.destroy', $outstanding->id)}}">
                                @csrf
                                @method('DELETE')
                                @can('outstanding-delete')
                                <button type="submit" class="btn "><i class="fa fa-trash-o"></i></button> @endcan
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
