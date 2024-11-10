<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Frontend\Products;

use App\Models\Brand;

use App\Models\Category;


class SearchController extends Controller
{
    //
    public function search(Request $request) {
        $search = $request->input('search');
        $dataCategory = Category::all();
        $dataBrand = Brand::all();
        $dataProduct = Products::where('name', 'like', '%'. $search .'%')->get()->toArray();
        return view('frontend/search', compact('dataProduct','dataCategory', 'dataBrand'));
    }

    public function searchPost(Request $request) {
        $data = $request->except('_token');
        $query = Products::query();

        // Áp dụng bộ lọc tìm kiếm
        if (!empty($data['search'])) {
            $query->where('name', 'like', '%'.$data['search'].'%');
        }
    
        if (!empty($data['id_category'])) {
            $query->where('id_category', $data['id_category']);
        }
    
        if (!empty($data['id_brand'])) {
            $query->where('id_brand', $data['id_brand']);
        }
    
        if (!empty($data['status'])) {
            $query->where('status', $data['status']);
        }
    
        // Áp dụng bộ lọc giá
        if (!empty($data['price'])) {
            switch ($data['price']) {
                case '0-1000':
                    $query->whereBetween('price', [0, 1000]);
                    break;
                case '1000-2000':
                    $query->whereBetween('price', [1000, 2000]);
                    break;
                // Thêm các trường hợp khác nếu cần
            }
        }
        $dataProduct = $query->get()->toArray();

        dd($dataProduct);
    }

    public function searchPrice(Request $request) {
        $data = $request->input('price');
        $price = explode(',',$data,);
        $query = Products::query();
        $query->whereBetween('price', [$price[0], $price[1]]);
        $dataProduct = $query->get()->toArray();
        return $dataProduct;
    }
}
