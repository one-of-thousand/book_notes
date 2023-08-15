
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="{{ route('note.home') }}"><img src="{{asset('storage/logo_whiteback.png')}}" style="height: 1.5rem" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('note.home') }}">ホームに戻る</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('note.create') }}">Noteを書く</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('note.index') }}">Noteを見る</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('sentence.index') }}">抜粋を見る</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container bg-light">
        <p class="text-end"><?php $user = Auth::user(); ?>{{ $user->name }} さんのNote</p>
    </div>
    
</header>
