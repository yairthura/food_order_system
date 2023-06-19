<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // direct user list page

    public function userList(){
        $user = User::where('role','admin')->paginate(3);
      return view('admin.user.list',compact('user'));
    }

    //change user role

    public function userChangeRole(Request $request){
        $updateSource =[
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);
    }

}
