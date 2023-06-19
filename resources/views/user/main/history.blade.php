@extends('user.layouts.master')
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height:400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order Id</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle">{{ $o->created_at->format('F-j-Y') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->total_price }}</td>

                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <span class="text-warning"><i class="fa-solid fa-clock me-2"></i>
                                            Pending....</span>
                                    @elseif($o->status == 1)
                                        <span class="text-success"><i class="fa-solid fa-chceck me-2"></i> Success</span>
                                    @elseif($o->status == 2)
                                        <span class="text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i>
                                            Reject</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                    <div class="mt-3">
                        {{ $order->links() }}
                    </div>
                </table>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
