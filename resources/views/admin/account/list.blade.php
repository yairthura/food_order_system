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
                                <h2 class="title-1">Product List</h2>
                            </div>
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <i class="fa-solid fa-circle-xmark"></i> {{ session('deleteSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-3">
                            <h3 class="text-secondary">Search Key : <span class="text-danger">{{ request('key') }} </span>
                            </h3>
                        </div>
                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#list') }}">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search"
                                        value="{{ request('key') }}">
                                    <button class="btn bg-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-2 offset-10 bg-white shadow-sn py-2 px-2 text-center">
                            <h3><i class="fa-solid fa-database"></i>- ({{ $admin->total() }})</h3>
                        </div>
                    </div>
                    {{-- @if (count($pizzas) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">
                                        <td class="col-2">
                                            @if ($a->image == null)
                                                <img src="{{ asset('image/default_user.jag') }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}"
                                                    class="img-thumbnail shadow-sm" alt="">
                                            @endif
                                        </td>
                                        <td class="col-3">{{ $a->name }}</td>
                                        <td class="col-2">{{ $a->email }}</td>
                                        <td class="col-2">{{ $a->gender }}</td>
                                        <td class="col-2">{{ $a->phone }}</td>
                                        <td class="col-2">{{ $a->address }}</td>
                                        <td>
                                            <div class="table-data-feature">
                                                {{-- <a href="@if (Auth::user()->id == $a->id) # @else{{ route('admin#delete')}}  @endif"> --}}
                                                @if (Auth::user()->id == $a->id)
                                                @else
                                                    <a href="{{ route('admin#changeRole', $a->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Change Admin Role">
                                                            <i class="fa-solid fa-person-circle-minus"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('admin#delete', $a->id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $admin->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
