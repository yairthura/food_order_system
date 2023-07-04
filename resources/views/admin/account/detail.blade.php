@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7 mb-2">
                @if (session('updateSuccess'))
                    <div class="">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-xmark"></i> {{ session('updateSuccess') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="class">
                                <a href="{{ route('admin#list') }}">
                                    <i class="fa-solid fa-arrow-left text-dark "></i>
                                </a>
                                {{-- <i class="fa-solid fa-arrow-left text-dark " onclick="history.back()"></i> --}}
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info </h3>
                            </div>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('image/default_user.jpg') }}" class="shadow-sm" />
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" />
                                    @endif
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-3"><i class="fa-solid fa-user-pen me-2"></i>{{ Auth::user()->name }}
                                    </h4>
                                    <h4 class="my-3"><i class="fa-solid fa-envelope me-2"></i>{{ Auth::user()->email }}
                                    </h4>
                                    <h4 class="my-3"><i class="fa-solid fa-phone me-2"></i>{{ Auth::user()->phone }}</h4>
                                    <h4 class="my-3"><i
                                            class="fa-solid fa-mars-and-venus me-2"></i>{{ Auth::user()->gender }}</h4>
                                    <h4 class="my-3"><i
                                            class="fa-solid fa-address-card me-2"></i>{{ Auth::user()->address }}
                                    </h4>
                                    <h4 class="my-3"><i
                                            class="fa-solid fa-user-clock me-2"></i>{{ Auth::user()->created_at->format('j-F-Y') }}
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-2 mt-3">
                                    <a href="{{ route('admin#edit') }}">
                                        <button type="submit" class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
