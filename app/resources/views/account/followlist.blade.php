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
    <div class="mt-4 text-center">
        <a href="#top" class="text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded">Topに戻る</a>
    </div>
</div>
@endsection
