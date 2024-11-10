<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Country;

use App\Http\Requests\CountryRequest;

class CountryController extends Controller
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
        $data = Country::all()->toArray();
        // dd($data);
        return view('admin/country', compact('data'));
        
    }
    public function add_country()
    {
        //
        return view('admin/addcountry');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CountryRequest $request)
    {
        //
        $data = $request->all();
        if (Country::create($data)) {
            return redirect()->route('admin.country');
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
        $data = Country::where('id',$id)->get()->toArray();
        // dd($data);
        // $data =  DB::table('cauthu')->where('id',$id)->get()->toArray();
        return view('admin/editcountry', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        //
        Country::where('id',$id)->update(['name'=>$request->name]);
        return redirect()->route('admin.country');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Country::where('id',$id)->delete();
        $data = Country::all()->toArray();
        return redirect()->route('admin.country');
    }
}
