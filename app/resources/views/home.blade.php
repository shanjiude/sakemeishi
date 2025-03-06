@extends('layouts.main')

@section('content')
<article>
    <div class="container">
        <p>お酒の好みを共有しよう！</p>
        <a href="{{ route('login') }}" class="btn">ログイン</a>
        <a href="{{ route('register') }}" class="btn">新規登録</a>
    </div>
    <div class="canva-embed">
        <iframe loading="lazy"
            src="https://www.canva.com/design/DAGgXRP_dJc/R-5l7mG35DvoAL1NC9MiUQ/view?embed" allowfullscreen="allowfullscreen" allow="fullscreen">
        </iframe>
    </div>
</article>
@endsection
