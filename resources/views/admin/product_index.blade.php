@extends('admin.layout')
@section('title') {{ $pageTitle ? $pageTitle : '' }} | @parent @stop

@section('page-css')
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" />
@stop

@section('main')

        <!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <h1>
        {{ $pageTitle ? $pageTitle : '' }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Shops</li>
    </ol>
</section> -->

<!-- Main content -->
    <!-- Info boxes -->
    <section class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header box-header-primary">
                  <div class="row">
                  <div class="col-xs-12">
                  </div>
                  </div>
                  <h3 class="box-title">{{ empty($pageTitle) ? '' : $pageTitle }}</h3>
                </div>
          <div class="box-body">
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered" id="jDataTable" >
                        <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Model</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Unite Price</th>
                            <th>Time</th>
                            <th>In Stock</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>

                </div><!-- /.box-body -->
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
            ajax: '{{ route('all_products_data') }}',
            "columns": [
                //title will auto-generate th columns
                { "data" : "product_name", "name" : "product_name" },
                { "data" : "product_model",  "name" : "product_model" },
                { "data" : "brand_id",  "name" : "brand_id" },
                
                { "data" : "category_id",  "name" : "category_id" },
                { "data" : "unite_price",  "name" : "unite_price" },
                { "data" : "stock",  "name" : "stock" },
                { "data" : "created_at",  "name" : "created_at" },
                { "data" : "actions",  "name" : "actions"}, 
            ]
        });

        $('body').on('click', '.deleteBrands', function(){
            var selector = $(this);
            var id = selector.attr('data-id');
            var confirmDelete = confirm('Are you sure!');
            if( ! confirmDelete) return;
            $.ajax({
                type : 'POST',
                url : '{{ route('delete_product') }}',
                data : { product_id : id, _token : '{{ csrf_token() }}' },
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
