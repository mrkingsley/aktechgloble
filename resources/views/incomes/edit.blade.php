@extends('layouts.db')

@section('main')

<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Income</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                        <form class="form-horizontal" action="{{ route('incomes.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="income_id" value="{{ $income->id }}">
                            <div class="form-group">
                              <div class="col-sm-7">
                                    <input type="text" id="income_title" class="form-control" placeholder="Email address" required="required" autofocus="autofocus" name="income_title" value="{{ $income->income_title }}">
                                    <label for="income_title">Income Description</label>
                                </div>
                            </div>
                            <div class="form-group">
                                 <div class="col-sm-7">
                                    <input type="number" step="any" min="0.01" id="income_amount" class="form-control" placeholder="Password" required="required" name="income_amount" value="{{ $income->income_amount }}">
                                    <label for="income_amount">Income Amount</label>
                                </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-7">
                                    <input type="date" id="income_date" class="form-control" placeholder="Income Date" required="required" name="income_date" value="{{ $income->income_date }}">
                                    <label for="income_date">Income Date</label>
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('incomes.index') }}" class="btn btn-success">Back</a>
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

