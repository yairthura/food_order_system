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
                    <form action="{{ route('admin#changeStatus') }}" method="get">
                        @csrf
                        <div class="input-group mb-3 ">

                            <div class="col-3">
                                <select name="orderStatus" class="form-control col-3" id="orderStatus">
                                    <option value="">All
                                    </option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                    </option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Success
                                    </option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject
                                    </option>
                                </select>
                            </div>

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-sm bg-dark text-white ms-3">Search</button>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $o)
                                    <tr class="tr-shadow ">
                                        <input type="hidden" class="orderId" value="{{ $o->id }}">
                                        <td>{{ $o->user_id }}</td>
                                        <td>{{ $o->user_name }}</td>
                                        <td>
                                            <a href="{{ route('admin#listInfo', $o->order_code) }}">
                                                {{ $o->order_code }}
                                            </a>
                                        </td>
                                        <td>{{ $o->created_at->format('F-j-Y') }}</td>
                                        <td>{{ $o->total_price }}kyats</td>
                                        <td>
                                            <select name="status" class="form-control statusChange">
                                                <option value="0" @if ($o->status == 0) selected @endif>
                                                    Pending
                                                </option>
                                                <option value="1" @if ($o->status == 1) selected @endif>
                                                    Success
                                                </option>
                                                <option value="2" @if ($o->status == 2) selected @endif>
                                                    Reject
                                                </option>
                                            </select>
                                        </td>
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

@section('scriptSection')
    <script>
        $(document).ready(function() {
            // change status
            $('.statusChange').change(function() {
                $parentNode = $(this).parents("tr");
                $currentStatus = $(this).val();
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                };
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })
            })


        })
    </script>

@endsection
