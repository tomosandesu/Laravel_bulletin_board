<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    //
    public function create(Post $post){
        return view('comment.create', compact('post'));
    }
    //今回のPOST $postはコメントを追加する対象の投稿を識別するためのものです。
    //Request $requestは、フォームから送られてきたデータも含まれています。
    public function store(Request $request, Post $post){
        //$postに返信内容を追加するが目的
        //返信ボタンで受け取った内容（$request）の中の返信データ（comment）を200文字以内制限（バリデーション）
        $request->validate([
            'comment' => 'required|max:200'
        ]);

        $post->comments()->create([
            'comment'=>$request->comment,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('post.index');
    }

    //返信内容の編集画面表示
    public function edit($id){
        $comment = Comment::find($id);
        return view('comment.edit', compact('comment'));
    }
    public function update(Request $request, Comment $comment){

        $validated = $request->validate([
            'comment' => 'required|max:400',

        ]);

        $validated['user_id'] = auth()->id();

        $comment->update($validated);

        $request->session()->flash('message', '更新しました');
        // 送信ボタンを押すと投稿一覧画面へ移動する
        return redirect()->route('comments.edit', ['comment' => $comment->id]);
    }
       //削除処理
       public function destroy(Request $request, Comment $comment){
        //Postクラス個別投稿削除
        $comment->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('post.index');
    }
    
}
