<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>投稿一覧ページ</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
            <a class="navbar-brand display-4 ml-4 mr-4" href="#">投稿一覧</a>
            <div class="collapse navbar-collapse" id="navbarNav">
            
            <a href="{{ route('dashboard') }}" class="btn btn-outline-success ml-4 mr-4" role="button">マイページ</a>
            <a href="{{ route('post.create') }}" class="btn btn-outline-info" role="button">新規投稿</a>

                <!-- その他のナビゲーション項目 -->
                
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle font-size-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            メニュー
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">アカウント画面</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                ログアウト
                            </a>
                            <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        {{-- 投稿フォームを送信後、無事に保存できた場合。「保存できました」という文章が表示 --}}
        @if(session('message'))
        <div class="alert alert-primary" role="alert">
            {{ session('message') }}
          </div>
        @endif
        <div class="mx-auto px-4 ">
            @foreach ($posts as $post)
                <div class="border rounded-md shadow-md my-4 p-4">
                    <!-- 投稿のタイトル -->
                    <div class="row justify-content-between font-semibold text-bg-primary mb-5 pb-3 border-bottom">
                        <div class="col-4">
                            <a href="{{ route('post.show', $post) }}" class="text-primary">
                                <span class="badge text-bg-info display-3">タイトル ： </span>{{ $post->title }}
                            </a>
                        </div>

                        <div class="contains">
                            <div class="row">
                                @if(auth()->user() && $post->user_id === auth()->user()->id) 
                                    <a href="{{ route('post.edit', $post) }}" class="btn btn-primary ms-auto">編集</a>
                                    <form method="post" action="{{ route('post.destroy', $post) }}">
                                    @csrf
                                    @method('delete')
                                        {{-- 削除ボタンをbuttonタグで作成する場合は、type属性をsubmitにすること --}}
                                        <button class="btn btn-danger"  type="submit" onclick="deleteFunction()">削除</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- 投稿の内容 -->
                    <p class="mb-3">
                        内容：{{ $post->comment }}
                    </p>


                    <div class="row justify-content-between">
                        <div class="col-4">
                            <a href="{{ route('comments.create', $post->id) }}" class="btn btn-primary ms-auto">返信</a>
                        </div>
                        {{-- いいねボタン設置 --}}
                        <div class="col-2">
                            {{-- いいねされてる？ --}}
                            <div class="row">
                            @if($post->isLikedBy(auth()->user()))
                                <form action="{{ route('likes.destroy', $post) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger">いいね取り消し</button>
                                </form>
                            @else
                                <form action="{{ route('likes.store', $post) }}" method="post">
                                @csrf
                                    <button type="submit" class="btn btn-outline-info">いいね</button>
                                </form>
                            @endif
                            <p class="lm-2">{{ $post->likers ? $post->likers->count() : 0 }}いいね</p>
                            </div>
                        </div>
                    </div>

                    <!-- 投稿日時と投稿者名 -->
                    <div class="text-sm text-gray-500">
                        {{ $post->user->name ?? '匿名' }} / {{ $post->created_at->format('Y-m-d H:i') }}
                    </div>
                    <div class="mb-2">

                    


                    {{-- 返信内容について --}}
                        <ul>
                            @foreach($post->comments as $comment)
                                <div class="container border rounded-md shadow-md my-4 p-4">
                                    <div class="row">
                                        返信：{{ json_decode('"' . $comment->comment . '"') }}
                                    </div>
                                    <div class="row offset-10">
                                        @if(auth()->user() && $comment->user_id === auth()->user()->id) 
                                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary ms-auto">編集</a>
                                            <form method="post" action="{{ route('comments.destroy', $comment) }}">
                                                @csrf
                                                @method('delete')
                                                    {{-- 削除ボタンをbuttonタグで作成する場合は、type属性をsubmitにすること --}}
                                                    <button class="btn btn-danger"  type="submit" onclick="deleteFunction()">削除</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

        </div>


        {{ $posts->links('vendor.pagination.custom') }}
    
    </div>
    
</body>
</html>