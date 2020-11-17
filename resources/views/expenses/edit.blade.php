@extends('layouts.db')

@section('main')


<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Expense</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                        <form class="form-horizontal" action="{{ route('expenses.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="expense_id" value="{{ $expense->id }}">
                            <div class="form-group">
                              <div class="col-sm-7">
                                    <input type="text" id="expense_title" class="form-control" placeholder="Email address" required="required" autofocus="autofocus" name="expense_title" value="{{ $expense->expense_title }}">
                                    <label for="expense_title">Expense Description</label>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-7">
                                    <input type="number" step="any" min="0.01" id="expense_amount" class="form-control" placeholder="Password" required="required" name="expense_amount" value="{{ $expense->expense_amount }}">
                                    <label for="expense_amount">Expense Amount</label>
                                </div>
                            </div>
                            <div class="form-group">
                                 <div class="col-sm-7">
                                    <input type="date" id="expense_date" class="form-control" placeholder="Password" required="required" name="expense_date" value="{{ $expense->expense_date }}">
                                    <label for="expense_date">Expense Date</label>
                                </div>
                            </div>
                       <div class="float-right">
                                <a href="{{ route('expense.index') }}" class="btn btn-success">Back</a>
                                <button type="submit" class="btn btn-primary">Update</button>
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
