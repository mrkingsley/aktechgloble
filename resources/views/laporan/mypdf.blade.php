<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aktech Global Communication</title>
  </head>
  <body>
<!-- Site wrapper -->
<section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                    <div class="row">
                    <div class="box-header bg-white">
                    <div class="box-header with-border"><h4 class="font-weight-bold">Report Statement</h4></div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                              <table width="100%" class="table table-borderless">
                                <tr>
                                @foreach ($Transcation as $Transcation)
                                    <td width="38%" class="font-weight-bold">Invoices Number</td>
                                    <td width="2%" class="font-weight-bold">:</td>
                                    <td width="60%" class="font-weight-bold">{{$Transcation->invoices_number}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Admin</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$Transcation->user->name}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Date</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$Transcation->created_at}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <table width="100%" class="table table-borderless">
                                <tr>
                                    <td width="38%">Pay</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$Transcation->pay}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Total</td>
                                    <td width="2%">:</td>
                                    <td width="60%">{{$Transcation->total}}</td>
                                </tr>
                                <tr>
                                    <td width="38%">Client</td>
                                    <td width="2%">:</td>
                                    <td width="60%">Take Away Customer</td>
                                </tr>                   @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-sm" width="100%">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                     @foreach ($Transcation as $Transcation)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$Transcation->product->name}}</td>
                                            <td>{{$Transcation->qty}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    <!-- /.row -->


</section><!-- /.content -->

</body>
</html>
