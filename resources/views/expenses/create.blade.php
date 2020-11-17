@extends('layouts.db')

@section('main')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">New Expense</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                        <form class="form-horizontal" action="{{ route('expense.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                              <div class="col-sm-7">
                                    <input type="text" id="expense_title" class="form-control" placeholder="Expense Description" required="required" autofocus="autofocus" name="expense_title">
                                    <label for="expense_title">Expense Description</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-7">
                                    <input type="number" step="any" id="expense_amount" min="0.01"  class="form-control" placeholder="Expense Amount" required="required" name="expense_amount">
                                    <label for="expense_amount">Expense Amount</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-7">
                                    <input type="date" id="expense_amount" class="form-control" placeholder="Expense Date" required="required" name="expense_date" value="{{ date('Y-m-d') }}">
                                    <label for="expense_amount">Expense Date</label>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('expense.index') }}" class="btn btn-success">Back</a>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                   
</div><!-- /.box-body -->


</div><!-- /.box -->



</div> <!-- /.col -->
</div>
</div>
<!-- /.row -->


</section><!-- /.content -->
@endsection
