<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//postモデルを使用することを宣言する。
use App\Models\Post;

class PostController extends Controller
{


    //投稿一覧画面表示
    public function index(){
        //postテーブルのデータを取得(compactの括弧内のpostsと$postになっていたので注意‼️)
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('post.index', compact('posts'));
    }


    // 投稿フォームを表示
    public function create(){
        return view('post.create');
    }
    // 投稿内容を保存
    public function store(Request $request){
        //バリデーションを行う際はリレーションに関するカラムは除外する。関係ないものだから。
        $validated = $request->validate([
            'title' => 'required|max:20',
            'comment' => 'required|max:400',

        ]);
        //ログインしたユーザーID情報をバリデーションデータに追加
        $validated['user_id'] = auth()->id();
        //バリデーションしたデータを$postに代入する
        $post = Post::create($validated);
        //投稿フォームの内容を受け取ったら、「保存しました」という文章を表示。
        $request->session()->flash('message', '保存しました');
        // 送信ボタンを押すと投稿一覧画面へ移動する
        return redirect()->route('post.index');
    }
    //投稿詳細画面に遷移(依存注入のPost $postでデータベースへ該当ID情報を依頼し、取得できる)
    public function show(Post $post){
        return view('post.show', compact('post'));
    }

    //編集画面表示
    public function edit(Post $post){
        return view('post.edit', compact('post'));
    }
    public function update(Request $request, Post $post){

        $validated = $request->validate([
            'title' => 'required|max:20',
            'comment' => 'required|max:400',

        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $request->session()->flash('message', '更新しました');
        // 送信ボタンを押すと投稿一覧画面へ移動する
        return redirect()->route('post.index');
    }
    //削除処理
    public function destroy(Request $request, Post $post){
        //Postクラス個別投稿削除
        $post->delete();
        $request->session()->flash('message', '削除しました');
        return redirect()->route('post.index');
    }

}
