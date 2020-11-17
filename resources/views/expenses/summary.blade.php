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
                  <h3 class="box-title"> Summary Of Expenses Over Incomes</h3>
                </div>
          <div class="box-body">
          <div class="row">
        	<div class="col-xl-6 offset-xl-3 col-sm-12 mb-3">
        		<ul class="list-group">
				  <li class="list-group-item d-flex bg-info text-white justify-content-center align-items-center">
				    All Data<span class="badge primary-color">Result</span>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    Total Income
				    <span class="badge badge-primary badge-pill">{{ $total_income }}</span>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    Total Expense
				    <span class="badge badge-danger badge-pill">{{ $total_expense }}</span>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
				    Balance
				    <span class="badge badge-primary badge-pill">{{ $balance }}</span>
				  </li>
				</ul>
        	</div>
        </div>


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
            $('#order_table').DataTable();
        } );

    </script>
@endsection
