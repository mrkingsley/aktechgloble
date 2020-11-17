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
                  <div class="pull-left">
                    <h2>Users</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('users.create') }}">Add New User</a>
                    </div>
                    </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered" style="font-size:14px" id="order_table" >
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $user)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-info">{{ $v }}</label>
                                    @endforeach
                                @endif
                                </td>
                                <td>
                                    @if($user->status=='active')
                                        <span class="success">{{$user->status}}</span>
                                    @else
                                        <span class="warning">{{$user->status}}</span>
                                    @endif
                                </td>
                                <td>
                                @can('users-edit')

                                <a class="btn btn" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-pencil"></i></a>@endcan
                                @can('users-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'fa fa-trash-o']) !!}
                                    {!! Form::close() !!}
                                </td>@endcan
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
    <script src="js/pdfmake.min.js"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
    $('#order_table').DataTable({order: [],
    scrollX: true,

    });
} );

    </script>
@endsection
