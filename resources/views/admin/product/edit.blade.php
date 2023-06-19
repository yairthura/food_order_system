@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit </h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <img src="{{ asset('storage/' . $pizza->image) }}" />
                                        <div class="div">
                                            <input type="file"
                                                class="form-control @error('pizzaImage') is-invalid @enderror"
                                                name="pizzaImage">
                                            @error('pizzaImage')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <a href="">
                                                <button type="submit" class="btn bg-dark text-white col-12"><i
                                                        class="fa-solid fa-circle-chevron-right me-1"></i>Update
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row col-6 ">
                                        <input type="hidden" name="pizzaId" value="{{ $pizza->id }}">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="pizzaName" type="text"
                                                value="{{ old('pizzaName', $pizza->name) }}"
                                                class="form-control @error('pizzaName') is-invalid @enderror"
                                                placeholder="Enter Name...">
                                            @error('pizzaName')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Category</label>
                                            <select name="pizzaCategory" id=""
                                                class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                <option value="">Choose your category</option>
                                                @foreach ($categories as $c)
                                                    <option value="{{ $c->id }}"
                                                        @if ($pizza->category_id == $c->id) selected @endif>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('pizzaCategory')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="cc-pament" name="pizzaPrice" type="number"
                                                value="{{ old('pizzzaPrice', $pizza->price) }}"
                                                class="form-control @error('pizzzaPrice') is-invalid @enderror"
                                                placeholder="Enter Price...">
                                            @error('pizzzaPrice')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" name="pizzaWaitingTime" type="number"
                                                value="{{ old('pizzaWaitingTime', $pizza->waiting_time) }}"
                                                class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                placeholder="Enter Waiting Time...">
                                            @error('pizzaWaitingTime')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Description</label>
                                            <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" id=""
                                                cols="30" rows="10" placeholder="Enter Description">{{ old('pizzaDescription', $pizza->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
