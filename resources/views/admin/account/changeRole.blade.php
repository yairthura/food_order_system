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
                                <h3 class="text-center title-2">Change Role </h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#change', $account->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        @if ($account->image == null)
                                            <img src="{{ asset('image/default_user.jpg') }}"
                                                class="img-thumbnail shadow-sm " />
                                        @else
                                            <img src="{{ asset('storage/' . $account->image) }}" />
                                        @endif
                                        <div class="mt-3">
                                            <a href="">
                                                <button type="submit" class="btn bg-dark text-white col-12"><i
                                                        class="fa-solid fa-circle-chevron-right me-1"></i>Change
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row col-6 ">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" disabled name="name" type="text"
                                                value="{{ old('name', $account->name) }}"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Enter Old Password...">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <select name="role"class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif>
                                                    Admin
                                                </option>
                                                <option value="user" @if ($account->role == 'user') selected @endif>
                                                    User
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" disabled name="email" type="email"
                                                value="{{ old('email', $account->email) }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter Email...">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" disabled name="phone" type="number"
                                                value="{{ old('phone', $account->phone) }}"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                placeholder="Enter Phone...">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" disabled id=""
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose gender...</option>
                                                <option value="male" @if ($account->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($account->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <input id="cc-pament" disabled name="address" type="text"
                                                value="{{ old('address', $account->address) }}"
                                                class="form-control @error('address') is-invalid @enderror"
                                                placeholder="Enter Phone...">
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
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
