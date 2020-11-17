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
                  <form action="{{ route('bank.index') }}"  method="get">
                    <div class="row">
                    <div class="box-header with-border">
                    <h4 class="box-title">Detailed Pos Transactions</h4></div>
                        <div class="col-sm-7"><input type="text" name="search"
                                class="form-control form-control-sm col-sm-10 float-right"
                                placeholder="Search Transaction..." onblur="this.form.submit()"></div>
                        <div class="col-sm-2"><a href="{{ url('/bank/create')}}"
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
                            <th>Name</th>
                            <th>Phone No.</th>
                            <th>Transaction Type</th>
                            <th>Amount</th>
                            <th>Account Name</th>
                            <th>Account No.</th>
                            <th>S.Charges</th>
                            <th>B.Charges</th>
                            <th>G.Profit</th>
                            <th>Machine</th>
                            {{-- <th>Staff</th> --}}
                            <th>Remark</th>
                            <th>Time</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total:</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="text-success"><span>&#8358;</span>{{$bank->sum('charge')  - $bank->sum('bank_charge')}}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th ></th>
                            </tr>
                            </tfoot>
                    @foreach($bank as $index=>$bank)
                        <tr>
                        <td>{{$index+1}}</td>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->phone}}</td>
                        <td>{{ $bank->transaction}}</td>
                        <td><span>&#8358;</span>{{ $bank->amount}}</td>
                        <td>{{ $bank->account_name}}</td>
                        <td>{{ $bank->account_no}}</td>
                        <td><span>&#8358;</span>{{ $bank->charge}}</td>
                        <td class="text-danger"><span>&#8358;</span>{{ $bank->bank_charge}}</td>
                        <td  class="text-success"><span>&#8358;</span>{{$bank->charge - $bank->bank_charge}}</td>
                        <td>{{ $bank->machine}}</td>
                        {{-- <td>{{ $bank->user->name}}</td> --}}
                        <td>{{ $bank->remark}}</td>
                        <td>{{ $bank->created_at->diffForHumans() . $bank->created_at->format('F d, Y')}}</td>
                    </td>
                        <td>
                        @can('bank-edit')
                            <a class="btn " data-toggle="tooltip"data-placement="top"  href="{{ route('bank.edit',$bank->id) }}"><i class="fa fa-pencil"></i> </a> @endcan


                                <form onsubmit="return confirm('are you sure you want to delect this transaction!')" class="d-inline-block"style="display: inline-block" method="post" action="{{ route('bank.destroy', $bank->id)}}">
                                @csrf
                                @method('DELETE')
                                @can('bank-delete')
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
