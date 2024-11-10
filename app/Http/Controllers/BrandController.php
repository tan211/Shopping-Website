<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Brand;

use App\Http\Requests\BrandRequest;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $data = Brand::all()->toArray();
        // dd($data);
        return view('admin/brands/list', compact('data'));
        
    }

    public function add_brand()
    {
        //
        return view('admin/brands/add');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BrandRequest $request)
    {
        $data = $request->all();
        if (Brand::create($data)) {
            return redirect()->route('admin.brand');
        } else {
            echo 'Them that bia';
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
        $data = Brand::where('id',$id)->get()->toArray();
        return view('admin/brands/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        //
        Brand::where('id',$id)->update(['name'=>$request->name]);
        return redirect()->route('admin.brand');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Brand::where('id',$id)->delete();
        return redirect()->route('admin.brand');
    }
}
