<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home
    public function home(){
        $pizzas = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart =Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','category','cart','history'));
    }

    // change password page
    public function changePasswordPage(){
        return view ('user.password.change');

    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if (Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);

          //  Auth::logout();
//return redirect()->route('category#list');
return back()->with(['changePassword'=> 'Password Change Success....']);

        }


        return back()->with(['notMatch' => 'The Old Password not Match. Try Again!']);

    }

    //account change page
    public function accountChangePage(){
        return view('user.profile.account');

    }

   public function  accountChange($id,Request $request){

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
        return back()->with(['updateSuccess'=> 'User Account Change Success....']);
    }

    // filter pizza
    public function filter($id){
        $pizzas = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart =Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizzas','category','cart','history'));
    }

    // pizza details
    public function pizzaDetails($id){
        $pizza = Product::where('id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));

    }

    //cart list

    public function cartList(){

        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)
        ->get();

        $totalPrice =0;
        foreach($cartList as $c)
        {
            $totalPrice += $c->pizza_price * $c->qty;
        }
        return view('user.main.cart',compact('cartList','totalPrice'));
    }



    //direct history

    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('6');
        return view('user.main.history',compact('order'));
    }


    // password validatess

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
}
