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
                  <h3 class="box-title"><a href="{{ route('expense.create') }}" >Enter New Expense</a></h3></h3>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered" style="font-size:14px" id="order_table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Expense Description</th>
                            <th>Amount</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenses as $index=>$expense)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $expense->expense_title }}</td>
                        <td><span>&#8358;</span>{{ $expense->expense_amount }}</td>
                        <td>{{ $expense->expense_date }}</td>
                    </td>
                        <td>
                    
                            <a class="btn " data-toggle="tooltip"data-placement="top"  href="{{ route('expenses.edit',$expense->id) }}"><i class="fa fa-pencil"></i> </a>

                          
                                <form onsubmit="return confirm('are you sure you want to delect this transaction!')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('expenses.delete',$expense->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn"><i class="fa fa-trash-o"></i></button>
                        </form>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                        <th  colspan="2">Total</th>
                        <th class="text-danger"><span>&#8358;</span>{{ $expenses->sum('expense_amount') }}</th>
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
