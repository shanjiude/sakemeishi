@extends('layouts.main')

@section('content')
<article>
    <div class="container">
        <p>お酒の好みを共有しよう！</p>
        <a href="{{ route('login') }}" class="btn">ログイン</a>
        <a href="{{ route('register') }}" class="btn">新規登録</a>
    </div>
</article>
@endsection
