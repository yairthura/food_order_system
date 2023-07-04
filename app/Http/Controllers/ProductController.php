<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    // product page
    public function list(){
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('key'),function($query){
            $query->where('products.name','like','%' . request('key').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(5);

        // dd($pizzas->toArray());
        return view('admin.product.pizza',compact('pizzas'));
    }
// create page
public function createPage(){
    $categories = Category::select('id','name')->get();
    return view('admin.product.create',compact('categories'));
}
public function create(Request $request) {
    $this->productValidationCheck($request,"create");
    $date = $this->requestProductInfo($request);
    // if($request->hasFile('pizzaImage')){
        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $date['image'] =$fileName;
   // }
    Product::create($date);
    return redirect()->route('product#list');
}
// product delete
public function delete($id){
    Product::where('id',$id)->delete();
    return back()->with(['deleteSuccess'=>'Deleted...']);
}
// product details
// public function details()
// {
//     return view('admin.product.detail');
// }
public function details($id)
{
    $pizza = Product::select('products.*','categories.name as category_name')
    ->leftJoin('categories','products.category_id','categories.id')
    ->where('products.id',$id)->first();
    return view('admin.product.detail',compact('pizza'));
}
/// product edit/update
public function edit($id){
    $pizza = Product::where('id',$id)->first();
    $categories = Category::get();
    return view('admin.product.edit',compact('pizza','categories'));
}
public function update(Request $request)
{
    $this->productValidationCheck($request,"update");
    $data = $this->requestProductInfo($request);
    //for image
    if ($request->hasFile('pizzaImage')) {
        $dbImage = Product::where('id', $request->pizzaId)->first();
        $dbImage = $dbImage->image;
        if ($dbImage != null) {
            Storage::delete('public/'.$dbImage);
        }
        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public',$fileName);
        $data['image'] = $fileName;
    }
    Product::where('id', $request->pizzaId)->update($data);
    return redirect()->route('product#details',$request->pizzaId)->with(['updateSuccess'=>'Pizza Detail Updated']);
}
// request product info
private function requestProductInfo($request){
    return [
       'category_id' => $request->pizzaCategory,
        'name' => $request->pizzaName,
        'description' => $request->pizzaDescription,
        'waiting_time' => $request->pizzaWaitingTime,
        'price' => $request->pizzaPrice,
    ];
}
// product validation check
 private function productValidationCheck($request,$action){
    $validatationRules =[

    'pizzaName' => 'required|min:5|unique:products,name,'.$request->pizzaId,
        'pizzaCategory' => 'required',
        'pizzaDescription' => 'required|min:10',
        'pizzaPrice' => 'required',
        'pizzaWaitingTime' => 'required',
    ];
    $validatationRules['pizzaImage'] = $action == "create" ?  'required|mimes:png,jpeg,jpg,webp|file' : 'mimes:png,jpeg,jpg,webp|file';
    Validator::make($request->all(),[
    ])->validate();
 }
}
