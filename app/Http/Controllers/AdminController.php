<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class AdminController extends Controller
{
    // change password page
    public function changePasswordPage()
    {
        return view('admin.account.changePassword');
    }
    //change Password
    public function changePassword(Request $request)
    {
        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;
        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('category#list');
        }
        return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);
    }
    // direct admin details page
    public function details()
    {
        return view('admin.account.detail');
    }
    // direct admin edit page
    public function edit()
    {
        return view('admin.account.edit');
    }
    public function update($id, Request $request)
    {
        $this->accoutValidationCheck($request);
        $data = $this->getUserDate($request);
        //for image
        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;
            if ($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated']);
    }
    //admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
            $query->orWhere('name','like','%'.request('key').'%')
                  ->orWhere('email','like','%'.request('key').'%')
                 -> orWhere('gender','like','%'.request('key').'%')
                  ->orWhere('phone','like','%'.request('key').'%')
                  ->orWhere('address','like','%'.request('key').'%');
        })
        ->where('role','admin')
        ->paginate(3);
        $admin->appends(request()->all());
        return view('admin.account.list',compact('admin'));
    }
    //delete acc
    public function delete($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Deleted...']);
    }
//change role
public function changeRole($id){
    $account = User::where('id',$id)->first();
    return view('admin.account.changeRole',compact('account'));
}
// change
public function change($id,Request $request){
    $date = $this->requestUserDate($request);
    User::where('id',$id)->update($date);
    return redirect()->route('admin#list');
}
//
private function requestUserDate($request){
    return [
        'role'=> $request->role
    ];
}
    private function getUserDate($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }
    // account validation check
    private function accoutValidationCheck($request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpeg,jpg,webp|file',
            'address' => 'required',
        ])->validate();
    }
    //password validation check
    private function passwordValidationCheck($request)
    {
        Validator::make(
            $request->all(),
            [
                'oldPassword' => 'required|min:6',
                'newPassword' => 'required|min:6',
                'confirmPassword' => 'required|min:6|same:newPassword',
            ],
        )->validate();
    }
}
