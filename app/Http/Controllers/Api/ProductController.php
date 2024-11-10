<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Models\Frontend\Products;

use App\Models\Brand;

use App\Models\Category;

use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    //
    public $successStatus = 200;
    public function index()
    {
        //
        if (Auth::check()){
            $dataProduct = Products::all();
            return response()->json([
                'response' => 'success',
                'data' => $dataProduct
            ], $this->successStatus);
        } else {
            return response()->json([
                'response' => 'error',
                'errors' => ['errors' => 'invalid email or password'],
            ], $this->successStatus);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_product()
    {
        //
        if (Auth::check()){
            $dataCategory = Category::all();
            $dataBrand = Brand::all();
            return view('frontend/products/add', compact('dataCategory', 'dataBrand'));
        } else {
            return redirect()->route('users.login');
        }
    }


    public function create(Request $request)
    {
        //
        if (Auth::check()){
            $data = [];
            if ($request->hasfile('image'))
            {
                $userId = Auth::id();
                $directory = public_path('upload/product/'. $userId .'');
                if(!file_exists($directory)) {
                    mkdir($directory, 0777, true);
                }
                foreach($request->file('image') as $xx)
                {
                    $image = Image::read($xx);

                    $name = $xx->getClientOriginalName();
                    $name_2 = "hinh50_".$xx->getClientOriginalName();
                    $name_3 = "hinh200_".$xx->getClientOriginalName();
                    
                    $path = public_path('upload/product/'. $userId .'/'. $name.'');
                    $path2 = public_path('upload/product/'. $userId .'/' . $name_2.'');
                    $path3 = public_path('upload/product/'. $userId .'/' . $name_3.'');

                    $image->save($path);
                    $image->resize(50, 70)->save($path2);
                    $image->resize(200, 300)->save($path3);
                    
                    // lấy từng tên hình ảnh đưa vào mảng
                    $data[] = $name;
                }
            }
            $product= new Products();
            // json_encode:chuyen mảng sang chuỗi
            $product->fill($request->all());
            if ($product->status == 1) {
                $product->sale = 0;
            }
            $product->image=json_encode($data);
            $product->id_user = Auth::id();
            $product->save();
            return back()->with('success', 'Your images has been successfully');

        } else {
            return redirect()->route('users.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $dataProduct = Products::where('id',$id)->get()->toArray();
        $dataCategory = Category::all();
        $dataBrand = Brand::all();
        return view('frontend/products/edit', compact('dataCategory', 'dataBrand', 'dataProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $dataProduct = Products::where('id',$id)->first();
        $imageServer = json_decode($dataProduct->image);
        // dd($imageServer);
        // dd($imageUpload);
        $imageRemove = $request->removeimage;
        $product = $request->except('_token','removeimage');
        if (Auth::check()){
            $data = [];
            if ($request->hasfile('image'))
            {
                
                foreach($request->file('image') as $xx) {
                    $name = $xx->getClientOriginalName();
                    $imageUpload[] = $name;
                }
                $data = array_merge($imageServer,$imageUpload);
                if ($imageRemove != null) {
                    foreach ($data as $key=>$value) {
                        if (in_array($value,$imageRemove)) {
                            unset($data[$key]);
                        }
                    }
                }
                $data = array_values($data);
                if (count($data)>3) {
                    return redirect()->back()->withErrors('Toi da 3 hinh anh.');
                } else {
                    foreach($request->file('image') as $xx)
                    {
                        $userId = Auth::id();
                        $directory = public_path('upload/product/'. $userId .'');
                        if(!file_exists($directory)) {
                            mkdir($directory, 0777, true);
                        }
                        $name = $xx->getClientOriginalName();
                        if (in_array($name,$data)) {
                            $image = Image::read($xx);
                            $name_2 = "hinh50_".$xx->getClientOriginalName();
                            $name_3 = "hinh200_".$xx->getClientOriginalName();
                            
                            $path = public_path('upload/product/'. $userId .'/'. $name.'');
                            $path2 = public_path('upload/product/'. $userId .'/' . $name_2.'');
                            $path3 = public_path('upload/product/'. $userId .'/' . $name_3.'');
                            $image->save($path);
                            $image->resize(50, 70)->save($path2);
                            $image->resize(200, 300)->save($path3);
                        }
                    }
                    $product['image']=json_encode($data);
                }
            }
            if ($product['status'] == 1) {
                $product['sale'] = 0;
            }
            Products::findOrFail($id)->update($product);
            return back()->with('success', 'Your product has been update successfully');

            //unlink để xoá hình ảnh trong thư mục
        } else {
            return redirect()->route('users.login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Products::findOrFail($id)->delete();
        return back()->with('success', 'Your product has been delete successfully');
    }

    public function home()
    {
        //
        $dataProduct = Products::orderBy('created_at', 'desc')->get()->toArray();
        return view('frontend/index', compact('dataProduct'));
    }

    public function detail_product(string $id)
    {
        //
        $dataProduct = Products::findOrFail($id);
        $dataCategory = Category::all();
        $dataBrand = Brand::all();
        return view('frontend/products/detail', compact('dataProduct', 'dataCategory', 'dataBrand'));
    }

    public function add_to_cart(Request $request)
    {
        session_start();
        // dd($request);
        // session()->forget('Cart');
        $qty = $request->qty;
        $productId = $request->product_id;
        $cart = session()->get('Cart');
        // dd($qty);
        $check = false;
        if (session()->has('Cart')) {
            foreach ($cart as $key=>$value) {
                if ($cart[$key]['product_id'] == $productId) {
                    $cart[$key]['qty'] += 1;
                    $check = true;
                    break;
                }
            }
            if (!$check) {
                $cart[] = [
                    'product_id' => $productId,
                    'qty' => $qty,
                ];
            }
        } else {
            $cart[] = [
                'product_id' => $productId,
                'qty' => $qty,
            ];
        }
        session()->put('Cart', $cart);
        $totalQty = 0;
        foreach ($cart as $value) {
            $totalQty += $value['qty'];
        }
        return $totalQty;
        // return $cart;
    }

    public function list_cart() {
        // session_start();
        $cart = session()->get('Cart');
        $data = [];
        if (session()->has('Cart')) {
            foreach ($cart as $value) {
                $product = Products::where('id', $value['product_id'])->first();
                if ($product) {
                    $data[] = $product->toArray();
                }
            }
        }
        return view('frontend/carts/list', compact('data'));
    }

    public function update_cart(Request $request) {
        $sum = 0;
        $sumQty = 0;
        $id = $request->id;
        $chucnang = $request->chucnang;
        $cart = session()->get('Cart');
        if ($chucnang == 1) {
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $id) {
                    $cart[$key]['qty'] += 1;
                    session()->put('Cart', $cart);
                    break;
                }
            }
        }
        if ($chucnang == 2) {
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $id) {
                    $cart[$key]['qty'] -= 1;
                    session()->put('Cart', $cart);
                    break;
                }
            }
        }
        if ($chucnang == 3) {
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $id) {
                    unset($cart[$key]);
                    session()->put('Cart', $cart);
                    break;
                }
            }
        }
        foreach ($cart as $key => $value) {
            $product = Products::select('price')->where('id', $value['product_id'])->first();
            if ($product) {
                $price = $product->price;
                $sum += $price * $value['qty'];
                $sumQty += $value['qty'];
            }
        }
        $response = [
            'sum' => $sum,
            'sumQty' => $sumQty
        ];
        return  json_encode($response);
    }
    public function checkout(){
        $cart = session()->get('Cart');
        $data = [];
        if (session()->has('Cart')) {
            foreach ($cart as $value) {
                $product = Products::where('id', $value['product_id'])->first();
                if ($product) {
                    $data[] = $product->toArray();
                }
            }
        }
        return view('frontend/carts/checkout', compact('data'));
    }
}
