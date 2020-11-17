@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="min-height:85vh">
                <div class="card-header bg-white">
                    <form action="{{ url('/transcation') }}" method="get">
                        <div class="row">
                            <div class="col">
                                <h4 class="font-weight-bold">Products</h4>
                            </div>
                            <div class="col text-right">
                                <select name="" id="" class="form-control from-control-sm" style="font-size: 12px">
                                    <option value="" holder>Filter Category</option>
                                    <option value="1">All Category...</option>
                                </select>
                            </div>
                            <div class="col"><input type="text" name="search"
                                    class="form-control form-control-sm col-sm-12 float-right"
                                    placeholder="Search Product..." onblur="this.form.submit()"></div>
                            <div class="col-sm-3"><button type="submit"
                            style="font-size:14px"
                                    class="btn btn-primary btn-sm float-right btn-block">Search Product</button></div>
                        </div>
                    </form>
                </div>
                <div class="card-body" style="cursor: pointer"
                                            onclick="this.closest('form').submit();return false;">
                    <div class="row">
                        @foreach ($products as $product)
                       <div class="col-sm-3">
                            <div class="card mb-3">
                                <div class="view overlay">
                                   
                                </div>
                                <form action="{{url('/transcation/addproduct', $product->id)}}" method="POST">
                                @csrf
                                 @if($product->qty == 0)
                                <div class="card-body">
                                    <h2 class="card-text text-center font-weight-bold"
                                        style="text-transform: capitalize;"> <a href="{{ route('products.edit', $product->id) }}" style="color:black">
                                        {{ Str::words($product->name,4) }}</a> </h2>
                                        <p class="card-text text-center">Qty: ({{$product->qty}})</p>
                                    <p class="card-text text-center text-success"><span>&#8358;</span>: {{ number_format($product->price,2,',','.') }}
                                    </p>
                                    <button 
                                        class="btn btn-danger btn-block btn-sm">out of stock <i
                                                class="fas fa-cart-plus"></i></button>
                                               
                                </div>

                                @elseif($product->qty == 6)
                                <div class="card-body">
                                    <h2 class="card-text text-center font-weight-bold"
                                        style="text-transform: capitalize;color:black"> 
                                        {{ Str::words($product->name,4) }}</h2>
                                        <p class="card-text text-center">Qty: ({{$product->qty}})</p>
                                    <p class="card-text text-center text-success"><span>&#8358;</span>: {{ number_format($product->price,2,',','.') }}
                                    </p>
                              
                                     <button 
                                        class="btn btn-success btn-block btn-sm">(runing out of stock)Add to Sell <i
                                                class="fas fa-cart-plus"></i></button>
                               
                                
                              </div>     
                              @else
                                <div class="card-body">
                                    <h2 class="card-text text-center font-weight-bold"
                                        style="text-transform: capitalize;color:black">
                                        {{ Str::words($product->name,4) }} </h2>
                                        <p class="card-text text-center">Qty: ({{$product->qty}})</p>
                                    <p class="card-text text-center text-success"><span>&#8358;</span>: {{ number_format($product->price,2,',','.') }}
                                    </p>
                              
                                     <button 
                                        class="btn btn-primary btn-block btn-sm">Add to Sell <i
                                                class="fas fa-cart-plus"></i></button>
                               
                                
                              </div>         
                                @endif
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div>{{ $products->links() }}</div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="card" style="min-height:85vh">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col-sm-4">
                            <h4 class="font-weight-bold">Sells list</h4>
                        </div>
                        <div class="col-sm-8">
                            <select name="" id="" class="form-control from-control-sm" style="font-size: 13px">
                                <option value="Take Away Customer">Take Away Customer</option>
                                <option value="Workshop" holder>Workshop</option>
                                <option value="Other Customer" holder>Other Customer...</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="overflow-y:auto;min-height:53vh;max-height:53vh" class="mb-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="30%">Product</th>
                                    <th width="30%">Qty</th>
                                    <th width="30%" class="text-right">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no=1
                                @endphp
                                @forelse($cart_data as $index=>$item)
                                <tr>
                                    <td>
                                        <form action="{{url('/transcation/removeproduct',$item['rowId'])}}"
                                            method="POST">
                                            @csrf
                                            {{$no++}} <br><a onclick="this.closest('form').submit();return false;"><i
                                                    class="fas fa-trash" style="color: rgb(134, 134, 134)"></i></a>
                                        </form>
                                    </td>
                                    <td>{{Str::words($item['name'],3)}} <br><span>&#8358;</span>.
                                        {{ number_format($item['pricesingle'],2,',','.') }}
                                    </td>
                                    <td class="font-weight-bold">
                                        <form action="{{url('/transcation/decreasecart', $item['rowId'])}}"
                                            method="POST" style='display:inline;'>
                                            @csrf
                                            <button class="btn btn-sm btn-info"
                                                style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                    class="fas fa-minus"></i></button>
                                        </form>
                                        <a style="display: inline">{{$item['qty']}}</a>
                                        <form action="{{url('/transcation/increasecart', $item['rowId'])}}"
                                            method="POST" style='display:inline;'>
                                            @csrf
                                            <button class="btn btn-sm btn-primary"
                                                style="display: inline;padding:0.4rem 0.6rem!important"><i
                                                    class="fas fa-plus"></i></button>
                                        </form>
                                    </td>
                                    <td class="text-right"><span>&#8358;</span>:. {{ number_format($item['price'],2,',','.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Empty Cart</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="60%">Sub Total</th>
                            <th width="40%" class="text-right"><span>&#8358;</span>:
                                {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                        </tr>
                        <tr>
                            <th>
                                <form action="{{ url('/transcation') }}" method="get">
                                    Discount 10%
                                    <input type="checkbox" {{ $data_total['tax'] > 0 ? "checked" : ""}} name="tax"
                                        value="true" onclick="this.form.submit()">
                                </form>
                            </th>
                            <th><div class="text-right"><span>&#8358;</span>:
                                {{ number_format($data_total['tax'],2,',','.') }}</th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th class="text-right font-weight-bold"><span>&#8358;</span>:
                                {{ number_format($data_total['total'],2,',','.') }}</th>
                        </tr>
                    </table>
                    <div class="row" >
                    <div class="col-sm-4">
                            <button class="btn btn-success btn-sm btn-block" style="padding:2px!important"
                                data-toggle="modal" data-target="#fullHeightModalRight">Submit Sell</button>
                        </div>



                        <div class="col-sm-4">
                            <form action="{{ url('/transcation/clear') }}" method="POST">
                                @csrf
                                <button class="btn btn-danger btn-sm btn-block" style="padding:2px!important"
                                    onclick="return confirm('are you sure you want to clear cart ?');"
                                    type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i>Clear List</button>
                            </form>
                        </div>

                        <div class="col-sm-4">
                            <a class="btn btn-primary btn-sm btn-block"
                                style="padding:2px!important" href="{{url('/transcation/history')}}" target="_blank">History</a>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade right" id="fullHeightModalRight" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-full-height modal-right" role="document">


            <div class="modal-content">
                <div class="modal-header indigo">
                    <h6 class="modal-title w-100 text-light" id="myModalLabel">payment Information</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="60%">Sub Total</th>
                            <th width="40%" class="text-right"><span>&#8358;</span>:
                                {{ number_format($data_total['sub_total'],2,',','.') }} </th>
                        </tr>
                        @if($data_total['tax'] > 0)
                        <tr>
                            <th>Discount 10%</th>
                            <th class="text-right"><span>&#8358;</span>:
                                {{ number_format($data_total['tax'],2,',','.') }}</th>
                        </tr>
                        @endif
                    </table>
                    <form action="{{ url('/transcation/bayar') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="oke">Enter Amount...</label>
                        <input id="oke" class="form-control" type="number" name="bayar" autofocus />
                    </div>
                    <h3 class="font-weight-bold">Total:</h3>
                    <h1 class="font-weight-bold mb-5"><span>&#8358;</span>: {{ number_format($data_total['total'],2,',','.') }}</h1>
                    <input id="totalHidden" type="hidden" name="totalHidden" value="{{$data_total['total']}}" />

                    <h3 class="font-weight-bold">Paid:</h3>
                    <h1 class="font-weight-bold mb-5" id="pembayaran"></h1>

                    <h3 class="font-weight-bold text-primary">Balance:</h3>
                    <h1 class="font-weight-bold text-primary" id="kembalian"></h1>
                </div>
                
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveButton" disabled onClick="openWindowReload(this)">Save transcation</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    
    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @if(Session::has('error'))
    <script>
        toastr.error(
            'sorry you are out of stock| no products to sell, inform your boss'
        )

    </script>
    @endif

    @if(Session::has('errorTransaksi'))
    <script>
        toastr.error(
            'transaction error'
        )

    </script>
    @endif

    @if(Session::has('success'))
    <script>
        toastr.success(
            'Transaction successful | Thank Your'
        )

    </script>
    @endif

    <script>
        $(document).ready(function () {
            $('#fullHeightModalRight').on('shown.bs.modal', function () {
                $('#oke').trigger('focus');
            });
        });

        oke.oninput = function () {
            let jumlah = parseInt(document.getElementById('totalHidden').value) ? parseInt(document.getElementById('totalHidden').value) : 0;
            let bayar = parseInt(document.getElementById('oke').value) ? parseInt(document.getElementById('oke').value) : 0;
            let hasil = bayar - jumlah;
            document.getElementById("pembayaran").innerHTML = bayar ? '<span>&#8358;</span> ' + rupiah(bayar) + ',00' : '<span>&#8358;</span> ' + 0 +
                ',00';
            document.getElementById("kembalian").innerHTML = hasil ? '<span>&#8358;</span>' + rupiah(hasil) + ',00' : '<span>&#8358;</span> ' + 0 +
                ',00';

            cek(bayar, jumlah);
            const saveButton = document.getElementById("saveButton");   

            if(jumlah === 0){
                saveButton.disabled = true;
            }

        };

        function cek(bayar, jumlah) {
            const saveButton = document.getElementById("saveButton");   

            if (bayar < jumlah) {
                saveButton.disabled = true;
            } else {
                saveButton.disabled = false;
            }
        }

        function rupiah(bilangan) {
            var number_string = bilangan.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        }

    </script>

    @endpush

    @push('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <style>
        .gambar {
            width: 100%;
            height: 175px;
            padding: 0.9rem 0.9rem
        }

        @media only screen and (max-width: 600px) {
            .gambar {
                width: 100%;
                height: 100%;
                padding: 0.9rem 0.9rem
            }
        }

        html {
            overflow: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0px;
            /* Remove scrollbar space */
            background: transparent;
            /* Optional: just make scrollbar invisible */
        }

        /* Optional: show position indicator in red */
        ::-webkit-scrollbar-thumb {
            background: #FF0000;
        }

        .cart-btn {
            position: absolute;
            display: block;
            top: 5%;
            right: 5%;
            cursor: pointer;
            transition: all 0.3s linear;
            padding: 0.6rem 0.8rem !important;

        }

        .productCard {
            cursor: pointer;

        }

        .productCard:hover {
            border: solid 1px rgb(172, 172, 172);

        }

    </style>
    <!-- © 2020 Copyright: Tahu Coding -->
    @endpush
