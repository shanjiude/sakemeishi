@extends('layouts.main')

@section('content')
<div class="followlist-container">
    <h2 class="headline">フォロー一覧</h2>
    <div class="follow-list">
        @if($follows->isEmpty())
            <p class="not-following">フォローしているユーザーはいません。</p>
        @else
        <ul>
            @foreach($follows as $follow)
                <li class="follows">
                    <img src="{{ asset($follow->profile_picture) }}" alt="Profile Picture" width="50" height="50">
                    <p>{{ $follow->name }}</p>
                </li>
            @endforeach
        </ul>
        @endif
    </div>
    <div class="return-top">
        <a href="{{ route('account') }}" class="">プロフィールに戻る</a>
    </div>
</div>
@endsection


