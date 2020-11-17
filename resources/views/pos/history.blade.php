@extends('layouts.db')

@section('main')
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
                  <h3 class="box-title">Detailed Sales Informations</h3>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered" id="order_table" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Invoices No</th>
                                <th>Sales By</th>
                                <th>Paid In</th>
                                <th>Total Amount</th>
                                <th>Time</th>
                                <th>View Report</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                            @foreach ($history as $index=>$item)
                                <th>Total:</th>
                                <th></th>
                                <th></th>
                                <th><span>&#8358;</span>{{ $item->sum('pay') }}</th>
                                <th><span>&#8358;</span>{{ $item->sum('total') }}</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$item->invoices_number}}</td>
                                <td>{{$item->user->name}}</td>
                                <td><span>&#8358;</span> {{$item->pay}}</td>
                                <td><span>&#8358;</span> {{$item->total}}</td>
                                <td>{{ $item->created_at->diffForHumans() . $item->created_at->format('F d, Y')}}</td>
                            <td><a href="{{url('/transcation/laporan', $item->invoices_number )}}" class="btn btn-primary btn-sm"><i class="fas fa-print"></i></a></td>
                            </tr>
                        </tbody>
                        @endforeach                       
                    </table>
                    <div>{{ $history->links() }}</div>
                </div>
            </div>
    </div>
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