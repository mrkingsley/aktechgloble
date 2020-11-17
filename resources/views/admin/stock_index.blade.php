@extends('admin.layout')
@section('title') {{ $pageTitle ? $pageTitle : '' }} | @parent @stop

@section('page-css')
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" />
@stop

@section('main')



<!-- Main content -->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $pageTitle ? $pageTitle : '' }}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">

                <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered" id="jDataTable" >
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>In Shop</th>
                             <th>Total Product</th>
                            <th>Unite Price</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>

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
        $('#jDataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('all_stock_data') }}',
            "columns": [
                //title will auto-generate th columns
                { "data" : "product_id", "name" : "product_id" },
                { "data" : "shop_id",  "name" : "shop_id"},
                { "data" : "total_product",  "name" : "total_product" },
                { "data" : "unite_price",  "name" : "unite_price"},
                { "data" : "created_at",  "name" : "created_at"},
                { "data" : "actions",  "name" : "actions"},]
        });

        $('body').on('click', '.deleteStock', function(){
            var selector = $(this);
            var id = selector.attr('data-id');
            var confirmDelete = confirm('Are you sure!');
            if( ! confirmDelete) return;
            $.ajax({
                type : 'POST',
                url : '{{ route('delete_stock') }}',
                data : { stock_id : id, _token : '{{ csrf_token() }}' },
                success : function(data){
                    if(data.status == 1)
                    {
                        selector.closest('tr').hide('slow');
                    }
                }
            });
        });

    </script>
@endsection
