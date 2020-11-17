@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop

@section('page-css')
    <link href="{{ asset('assets/admin/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" />
@stop

@section('main')

    <!-- Content Header (Page header) -->
<!-- Main content -->
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

                        <table class="table table-hover table-striped table-bordered" id="jDataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Shop</th>
                                <th>Joining Date</th>
                                <th>Action</th>
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
            ajax: '{{ route('all_agents_data') }}',
            "columns": [
                //title will auto-generate th columns
                { "data" : "referral_id", "name" : "referral_id" },
                { "data" : "first_name",  "name" : "first_name" },
                { "data" : "shop_id",  "name" : "shop_id"},
                { "data" : "created_at",  "name" : "created_at"},
                { "data" : "action",  "name" : "action"},
            ]
        });

        $('body').on('click', '.deleteBrands', function(){
            var selector = $(this);
            var id = selector.attr('data-id');
            var confirmDelete = confirm('Are you sure!');
            if( ! confirmDelete) return;
            $.ajax({
                type : 'POST',
                url : '{{ route('delete_user') }}',
                data : { user_id : id, _token : '{{ csrf_token() }}' },
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