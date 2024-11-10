<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

use App\Http\Requests\BlogRequest;

class BlogController extends Controller
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
        $data = Blog::all()->toArray();
        return view('admin/blog', compact('data'));
    }
    public function add_blog()
    {
        //
        return view('admin/addblog');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(BlogRequest $request)
    {
        //
        $data = $request->except('_token');
        $file = $request->image;
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
        }
        if (Blog::create($data)) {
            if(!empty($file)){
                $file->move('upload/blogs/image', $file->getClientOriginalName());
            }
            return redirect()->route('admin.blog')->with('success', __('Update profile success.'));;
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
        

        // $data = $request->except(['_token']);
        // if (Blog::where('id',$id)->update($data)) {
        //     if(!empty($file)){
        //         $file->move('upload/blogs/image', $file->getClientOriginalName());
        //     }
        //     return redirect()->back();
        // } else {
        //     return redirect()->back()->withErrors('Update profile error.');
        // }
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
        $data = Blog::where('id',$id)->get()->toArray();
        // dd($data);
        // $data =  DB::table('cauthu')->where('id',$id)->get()->toArray();
        return view('admin/editblog', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        //
        // $data = Blog::where('id',$id)->update([
        //     'title'=>$request->title,
        //     'image'=>$request->image,
        //     'description'=>$request->description,
        //     'content'=>$request->content,
        // ]);
        // return redirect()->route('admin.blog');

        // $data = $request->all();
        $data = $request->except(['_token']);
        $file = $request->image;
        if(!empty($file)){
            $data['image'] = $file->getClientOriginalName();
        }
        if (Blog::where('id',$id)->update($data)) {
            if(!empty($file)){
                $file->move('upload/blogs/image', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Update profile success.'));
        } else {
            return redirect()->back()->withErrors('Update profile error.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Blog::where('id',$id)->delete();
        $data = Blog::all()->toArray();
        return redirect()->route('admin.blog');
    }
}
