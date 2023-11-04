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
    <title>投稿フォーム</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
            <a class="navbar-brand display-4 ml-4 mr-4" href="#">投稿フォーム</a>
            <div class="collapse navbar-collapse" id="navbarNav">
            
            <a href="{{ route('dashboard') }}" class="btn btn-outline-success ml-4 mr-4" role="button">マイページ</a>
            <a href="{{ route('post.index') }}" class="btn btn-outline-info" role="button">戻る</a>

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
            <form action="{{ route('post.update', $post) }}" method="POST">
            @csrf
            @method('patch')
                <div class="mb-3 mt-4">
                    <label for="title" class="form-label">タイトル</label>
                    <input name="title" type="text" class="form-control" id="title" placeholder="20文字以内で入力してください。" value="{{ old('title', $post->title) }}">
                    @error('title')
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">コメント</label>
                    <textarea name="comment" class="form-control" id="comment" rows="3" placeholder="400文字以内で入力してください。">{{ old('comment', $post->comment) }}</textarea>
                    @error('comment')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>    
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
       
</body>
</html>