@extends('admin.layouts.master')
@section('title', 'Category List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    {{-- <h3>Total - {{ $user->total() }}</h3> --}}
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">User List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($user as $user)
                                    <tr class="tr-shadow ">
                                        <td class="col-2">
                                            @if ($user->image == null)
                                                <img src="{{ asset('image/default_user.jpg') }}" class="shadow-sm" />
                                            @else
                                                <img src="{{ asset('storage/' . $user->image) }}" />
                                            @endif
                                        </td>
                                        <input type="hidden" name="" id="userId" value="{{ $user->id }}">
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->gender }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <select name="role" id="" class="form-control changeStatus">
                                                <option value="user" @if ($user->role == 'user') selected @endif>
                                                    User</option>
                                                <option value="admin" @if ($user->role == 'admin') selected @endif>
                                                    Admin</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div>
                            {{ $user->links() }}
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
                $userId = $parentNode.find('#userId').val();

                $data = {
                    'userId': $userId,
                    'role': $currentStatus
                };
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/change/role',
                    data: $data,
                    dataType: 'json',
                })
                location.reload();
            })


        })
    </script>

@endsection
