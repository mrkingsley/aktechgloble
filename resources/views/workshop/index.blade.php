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
                  <h3 class="box-title">Workshop</h3>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped datatable table-bordered" style="font-size:14px" id="order_table" >
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Hardware Dpt Account</th>
                        <th>Software Dpt Account</th>
                        <th>Remark</th>
                        <th>Time</th>
                        <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                    @foreach($workshop as $index=>$workshop)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $workshop->name }}</td>
                        <td><span>&#8358;</span>{{ number_format($workshop->hardware,2,',','.')}}</td>
                        <td><span>&#8358;</span>{{ number_format($workshop->software,2,',','.') }}</td>
                        <td>{{ $workshop->remark}}</td>
                        <td>{{ $workshop->created_at->diffForHumans() . $workshop->created_at->format('F d, Y')}}</td>
                       
                    </td>
                        <td>

                            <a class="btn" data-toggle="tooltip"data-placement="top"  href="{{ route('workshop.edit',$workshop->id) }}"><i class="fa fa-pencil"></i> </a> 


                                <form onsubmit="return confirm('are you sure you want to delect this user')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('workshop.destroy', $workshop->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                        </form>
                         
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tr>
                        <th  colspan="2">Total</th>
                        <th><span>&#8358;</span>{{ $workshop->sum('hardware') }}</th>
                        <th colspan="3"><span>&#8358;</span>{{  $workshop->sum('software') }}</th>
                    </table>
                    
                </div>

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
