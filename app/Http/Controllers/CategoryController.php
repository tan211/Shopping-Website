<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
        $data = Category::all()->toArray();
        // dd($data);
        return view('admin/categories/list', compact('data'));
        
    }

    public function add_category()
    {
        //
        return view('admin/categories/add');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryRequest $request)
    {
        $data = $request->all();
        if (Category::create($data)) {
            return redirect()->route('admin.category');
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
        $data = Category::where('id',$id)->get()->toArray();
        // dd($data);
        // $data =  DB::table('cauthu')->where('id',$id)->get()->toArray();
        return view('admin/categories/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //
        Category::where('id',$id)->update(['name'=>$request->name]);
        return redirect()->route('admin.category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Category::where('id',$id)->delete();
        return redirect()->route('admin.category');
    }
}
