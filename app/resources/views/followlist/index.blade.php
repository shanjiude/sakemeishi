@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="">フォロー一覧</h2>
    <div class="">
        @if($follows->isEmpty())
            <p>フォローしているユーザーはいません。</p>
        @else
        <ul>
            @foreach($follows as $follow)
                <li>{{ $follow->name }}</li>
            @endforeach
        </ul>
        @endif
    </div>
    <div class="">
        <a href="{{ route('account') }}" class="">Topに戻る</a>
    </div>
</div>
@endsection

