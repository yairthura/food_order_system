@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>


                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}" class="text-dark"><i
                                class="fa-solid fa-arrow-left-long"></i>Back</a>

                        <div class="row col-6">

                            <div class="card mt-4 ">
                                <div class="card-header">
                                    <h3><i class="fa-solid fa-clipboard me-3"></i> Order Info </h3>
                                    <small class="text-warning"><i class="fa-soild fa"></i> Include Delivery Charges</small>
                                </div>
                                <div class="card-body">
                                    <div class="row mt-2">
                                        <div class="col"><i class="fa-solid fa-user me-3"></i>Name</div>
                                        <div class="col">{{ strtoupper($orderList[0]->user_name) }}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col"><i class="fa-solid fa-barcode me-3"></i>Order Code</div>
                                        <div class="col"></i>{{ $orderList[0]->order_code }}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col"><i class="fa-solid fa-clock me-3"></i>Order Date</div>
                                        <div class="col"></i>{{ $orderList[0]->created_at->format('F-j-Y') }}</div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col"><i class="fa-solid fa-money-bill-wave me-3"></i>Total Price
                                        </div>
                                        <div class="col"></i>{{ $order->total_price }} kyats</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Qty</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow ">
                                        <td></td>
                                        <td>{{ $o->id }}</td>
                                        <td class="col-2"><img src="{{ asset('storage/' . $o->product_image) }}"
                                                class="img-thumbnail shadow-sm" alt=""></td>
                                        <td>{{ $o->product_name }}</td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $o->qty }}</td>
                                        <td>{{ $o->total }}kyats</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="mt-3">
                                {{ $order->links() }}
                            </div> --}}
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
