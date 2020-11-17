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
                  <div class="table-responsive">

                        <table class="table table-hover table-striped table-bordered" id="jDataTable" >

                        <thead>
                        <tr>
                            <!-- <th style="width: 10px">#</th> -->
                            <th>Shop Name</th>
                            <th>Status</th>
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
            ajax: '{{ route('all_shops_data') }}',
            "columns": [
                //title will auto-generate th columns
                // { "data" : "$+", "name" : "$+" },
                { "data" : "name", "name" : "name" },
                { "data" : "status",  "name" : "status"},]
        });

        $('body').on('click', '.deleteBrands', function(){
            var selector = $(this);
            var id = selector.attr('data-id');
            var confirmDelete = confirm('Are you sure!');
            if( ! confirmDelete) return;
            $.ajax({
                type : 'POST',
                url : '{{ route('delete_brand') }}',
                data : { brand_id : id, _token : '{{ csrf_token() }}' },
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
