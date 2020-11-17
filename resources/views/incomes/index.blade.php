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
                  <form action="{{ route('incomes.index') }}"  method="get">
                    <div class="row">
                    <div class="box-header with-border">
                    <h4 class="box-title"> Income List</h4></div>
                        <div class="col-sm-7"><input type="text" name="search"
                                class="form-control form-control-sm col-sm-10 float-right"
                                placeholder="Search Transaction..." onblur="this.form.submit()"></div>
                        <div class="col-sm-2"><a href="{{ url('/incomes/create')}}"
                                class="btn btn-primary btn-sm float-left btn-block">Add New Income</a></div>
                    </div>
                </form>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered " style="font-size:14px" id="order_table" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Income Description</th>
                            <th>Amount</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomes as $index=>$income)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $income->income_title }}</td>
                        <td><span>&#8358;</span>{{ $income->income_amount }}</td>
                        <td>{{ $income->income_date }}</td>
                    </td>
                        <td>
                            <a class="btn " data-toggle="tooltip"data-placement="top"  href="{{ route('incomes.edit',$income->id) }}"><i class="fa fa-pencil"></i> </a>

                                <form onsubmit="return confirm('are you sure you want to delect this transaction!')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('incomes.delete',$income->id) }}">
                                @csrf
                                @method('get')
                                <button type="submit" class="btn "><i class="fa fa-trash-o"></i></button>
                        </form>
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                        <th  colspan="2">Total</th>
                        <th class="text-success"><span>&#8358;</span>{{ $incomes->sum('income_amount') }}</th>
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
