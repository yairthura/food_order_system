@extends('layouts.master')
@section('content')
    <div class="login-form">
        <form action="{{ route('register') }}" method="post">
            @csrf
            @error('term')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Username</label>
                <input class="au-input au-input--full" type="text" name="name" placeholder="Username">
            </div>
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Email Address</label>
                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
            </div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Phone</label>
                <input class="au-input au-input--full" type="number" name="phone" placeholder="Phone">
            </div>
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Gender</label>
                <select name="gender" id="" class="form-control">
                    <option value="">Choose gender..</option>
                    <option value="male">Male</option>
                    <option value="Female">Female</option>
                </select>
                @error('gender')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Address</label>
                <input class="au-input au-input--full" type="text" name="address" placeholder="Address">
            </div>
            @error('address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Password</label>
                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
            </div>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="form-group">
                <label>Confirm Password</label>
                <input class="au-input au-input--full" type="password" name="password_confirmation"
                    placeholder="Confirm Password">
            </div>
            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">register</button>
        </form>
    </div>
@endsection
