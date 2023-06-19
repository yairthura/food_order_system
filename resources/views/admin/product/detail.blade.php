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
                                <a href="{{ route('product#list') }}">
                                    <i class="fa-solid fa-arrow-left text-dark "></i>
                                </a>
                                {{-- <i class="fa-solid fa-arrow-left text-dark " onclick="history.back()"></i> --}}
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Pizza Detail </h3>
                            </div>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    <img src="{{ asset('storage/' . $pizza->image) }}" />
                                </div>
                                <div class="col-7 ">
                                    <h3 class="my-3 text-decoration-underline">{{ $pizza->name }}</h3>
                                    <span class="my-3 btn bg-dark text-white"><i
                                            class="fa-solid fa-address-card me-2"></i>{{ $pizza->price }} kyats</span>
                                    <span class="my-3 btn bg-dark text-white"><i
                                            class="fa-solid fa-mars-and-venus me-2"></i>{{ $pizza->waiting_time }}mins</span>
                                    <span class="my-3 btn bg-dark text-white"><i
                                            class="fa-solid fa-phone me-2"></i>{{ $pizza->view_count }}</span>
                                    <span class="my-3 btn bg-dark text-white"><i
                                            class="fa-solid fa-phone me-2"></i>{{ $pizza->category_name }}</span>
                                    <span class="my-3 btn bg-dark text-white"><i
                                            class="fa-solid fa-user-clock me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}</span>
                                    <div class="my-3"><i class="fa-solid fa-envelope me-2"></i> Details</div>
                                    <div class="">{{ $pizza->description }} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 offset-2 mt-3">
                                    <a href="{{ route('product#edit', $pizza->id) }}">
                                        <button type="submit" class="btn bg-dark text-white">
                                            <i class="fa-solid fa-pen-to-square me-2"></i>Edit Pizza Details
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
