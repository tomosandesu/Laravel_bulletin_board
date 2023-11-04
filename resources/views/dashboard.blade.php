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
<title>マイページ</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-4">
            <a class="navbar-brand display-4 ml-4 mr-4" href="#">マイページ</a>
            <div class="collapse navbar-collapse" id="navbarNav">
            
            <a href="{{ route('post.create') }}" class="btn btn-outline-success ml-4 mr-4" role="button">新規投稿</a>
            <a href="{{ route('post.index') }}" class="btn btn-outline-info" role="button">投稿一覧</a>

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
        <div class="d-flex justify-content-center align-items-center vh-300">
            <div class="card mt-5" style="width: 30rem;">
                <ul class="list-group list-group-flush">
                {{-- <li class="list-group-item">ようこそ{{ $post->user->name ?? '匿名' }}さん‼️</li> --}}
                <li class="list-group-item">今日も投稿しましょー‼️</li>
                <li class="list-group-item">みんなの投稿もチェック‼️</li>
                </ul>
                <div class="card-footer">
                    さぁ、投稿をはじめしょー‼️
                </div>
            </div>
        </div>     
    </div>


    
    
    

</body>
</html>

