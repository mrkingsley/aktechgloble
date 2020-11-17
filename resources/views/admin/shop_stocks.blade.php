@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop

@section('page-css')
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" />
    @stop

@section('main')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($pageTitle) ? '' : $pageTitle }}
    </h1>

</section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    @include('admin.shop_left')
                </div><!-- /.col -->
                <div class="col-md-9">


                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ $pageTitle ? $pageTitle : '' }}</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                        <div class="table-responsive">

                            <table class="table table-bordered table-striped" id="jDataTable">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>In</th>
                                    <th>Total Product</th>
                                    <th>Unite Price</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                            </table>

                        </div><!-- /.box-body -->


                    </div><!-- /.box -->



                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->

@endsection


@section('page-js')
    <script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $('#jDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('shop_all_stocks_data', $shop->id) }}',
              "columns": [
                //title will auto-generate th columns
                { "data" : "product_id", "name" : "product_id" },
                { "data" : "shop_id",  "name" : "shop_id"},
                { "data" : "total_product",  "name" : "total_product" },
                { "data" : "unite_price",  "name" : "unite_price"},
                { "data" : "created_at",  "name" : "created_at"},]
        });
    </script>
@endsection