<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Frontend\Rates;
use App\Models\Frontend\Comments;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
        //
        $posts = Blog::paginate(3); 
        return view('frontend/blogs/blog', compact('posts'));
    }

    public function detail(string $id)
    {
        $posts = Blog::findOrFail($id);
        $data = Blog::select('id')->get()->toArray();
        $lastkey = array_key_last($data);
        $idPre = 0;
        $idNext = 0;
        foreach ($data as $key=>$value) {
            if ($value['id'] == $id) {
                if ($key-1 >= 0) {
                    $idPre = $data[$key-1]['id'];
                }
                if ($key+1 <= count($data)-1) {
                    $idNext = $data[$key+1]['id'];
                }
            }
        }
        $sum = 0;
        $rate = Rates::where('id_blog',$id)->get()->toArray();
        foreach ($rate as $key=>$value) {
            $sum += $value['rate'];
        }
        $avg =  round($sum / count($rate));
        $votes = count($rate);
        $cmt = Comments::where('id_blog',$id)->get();
        return response()->json([
            'posts' => $posts,
            'idPre' => $idPre,
            'idNext' => $idNext,
            'avg' => $avg,
            'votes' => $votes,
            'cmt' => $cmt,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $existingRate = Rates::where('id_blog',$request->id_blog)->where('id_user',$request->id_user)->first();
        if ($existingRate) {
            $existingRate->update($data);
        } else {
            Rates::create($data);
        }
        $averageRating = $this->calculateAverageRating($request->id_blog);
        return $averageRating;
        // $rate = Rates::where('id_blog',$request->id_blog)->get()->toArray();
        // foreach ($rate as $key => $value) {
        //     if ($request->id_user == $value['id_user']) {
        //         $data = Rates::where('id_blog',$request->id_blog)->endwhere('id_user',$request->id_user)->updated($data);
        //         $sum = 0;
        //         $rate = Rates::where('id_blog',$request->id)->get()->toArray();
        //         foreach ($rate as $key=>$value) {
        //             $sum += $value['rate'];
        //         }
        //         $avg =  round($sum / count($rate));
        //         return $avg;
        //     }
        // }
        // if (Rates::create($data)) {
        //     $sum = 0;
        //     $rate = Rates::where('id_blog',$request->id)->get()->toArray();
        //     foreach ($rate as $key=>$value) {
        //         $sum += $value['rate'];
        //     }
        //     $avg =  round($sum / count($rate));
        //     return $avg;
        // } else {
        //     return 'That bai';
        // }
    }
    private function calculateAverageRating($id_blog) {
        $sum = 0;
        $rate = Rates::where('id_blog',$id_blog)->get()->toArray();
        foreach ($rate as $key=>$value) {
            $sum += $value['rate'];
        }
        $avg =  round($sum / count($rate));
        return $avg;
    }

    public function cmt(Request $request)
    {
        //
        $data = $request->all();
        Comments::create($data);
        return response()->json(['data'=>$data]);
        // return $data;
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
