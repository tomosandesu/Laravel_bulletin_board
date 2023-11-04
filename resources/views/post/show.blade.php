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
            <a class="navbar-brand display-4 ml-4 mr-4" href="#">投稿詳細画面</a>
            <div class="collapse navbar-collapse" id="navbarNav">
            
            <a href="{{ route('post.index') }}" class="btn btn-outline-success ml-4 mr-4" role="button">戻る</a>
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
        <div class="mx-auto px-4">
                <div class="border rounded-md shadow-md my-4 p-4">
                    <!-- 投稿のタイトル -->
                    <h4 class="text-bg-primary mb-2 border-bottom pb-3">
                        タイトル：{{ $post->title }}
                    </h4>
                    
                    <!-- 投稿の内容 -->
                    <h4 class="text-bg-primary mb-5 mt-5">
                        内容：{{ $post->comment }}
                    </h4>
                    
                    <!-- 投稿日時と投稿者名 -->
                    <div class="text-sm text-gray-500">
                        <p>{{ $post->created_at }}</p>
                    </div>
                </div>
        </div>
    
</body>
</html>