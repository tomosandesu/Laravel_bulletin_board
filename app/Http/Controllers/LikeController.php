<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class LikeController extends Controller
{
    //
    public function store(Request $request, Post $post){
        $post->likers()->attach(auth()->id());
        $request->session()->flash('message', 'いいねしました');
        return redirect()->route('post.index');
    }
    public function destroy(Request $request, Post $post){
        $post->likers()->detach(auth()->id());
        $request->session()->flash('message', 'いいね削除しました');
        return redirect()->route('post.index');
    }
}
