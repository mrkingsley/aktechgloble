@extends('admin.layout')
@section('title') {{ empty($pageTitle) ? '' : $pageTitle }}   @stop

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

                        <table class="table table-hover table-striped table-bordered">
                            <tr>
                                <th>Name</th>
                                <td>{{ $lUser->get_fullname() }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $lUser->email }}</td>
                            </tr>

                            <tr>
                                <th>Mobile</th>
                                <td>{{ $lUser->mobile }}</td>
                            </tr>

                            @if($lUser->isShopAdmin())
                            <tr>
                                <th>Admin</th>
                                <td>{{ $lShop->name }}</td>
                            </tr>
                            @elseif($lUser->isUser())
                            <tr>
                                <th>Merchants</th>
                                <td>
                                    @foreach($lUser->joinedShops as $shop)
                                    {!! '<a href="' . route('user_shop_view', $shop->id) . '"> <strong>' . $shop->name . '</strong></a><br />' !!}
                                    @endforeach
                                </td>
                            </tr>

                            @endif

                            <tr>
                                <th></th>
                                <td><a href="{{ route('admin_profile_edit') }}" class="btn btn-info"> <i class="fa fa-pencil"></i>  Edit</a> </td>
                            </tr>

                        </table>


                    </div><!-- /.box-body -->


                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->

    </section><!-- /.content -->

@endsection

@section('page-js')

@endsection