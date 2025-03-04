@extends('layouts.main')
@section('title', 'ID検索')

@section('content')
<div class="container">
    <h2>ID検索</h2>

    <form action="{{ route('account.search.post') }}" method="POST">
        @csrf
        <input type="text" name="user_id" placeholder="表示IDを入力 (例: 00002)" required>
        <button type="submit" class="ID-search">検索</button>
    </form>

    @if(isset($user))
        <div class="search-result-container">
            <a href="{{ route('account.showOther', $user->id) }}" class="search-result">
                <img src="{{ asset('images/' . ($user->icon_path ?? 'default_icon.png')) }}" alt="User Icon" class="profile-icon">
                <p>{{ $user->name }}</p>
            </a>
            <div class="follow-container">
                <button id="follow-btn"
                        data-user-id="{{ $user->id }}"
                        class="px-2 py-2 bg-blue-500 text-white rounded">
                    {{ Auth::user()->isFollowing($user->id) ? 'フォロー解除' : 'フォロー' }}
                </button>
            </div>
        </div>
    @endif
</div>
<div class="other-container">
    <div class="button-container">
        <a href="{{ route('account') }}">戻る</a>
    </div>
</div>
@endsection
