@extends('layouts.main')
@section('title', 'フォロー一覧')

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
                    <a href="{{ route('account.showOther', $follow->id) }}" class="followlist-to-otherprofile">
                        <img class="follow-user-icon" src="{{ asset($follow->profile_picture) }}" alt="Profile Picture" width="50" height="50">
                        <p>{{ $follow->name }}</p>
                    </a>

                    @php
                        $favoriteDrinks = $follow->alcoholPreference->filter(function ($preference) {
                            return $preference->preference === '好き' && $preference->alcoholType;
                        });
                    @endphp
                <div class="follow-favorite-drinks">
                    <p class="pref-drink-label">お酒の好み：</p>

                    @if ($favoriteDrinks->isNotEmpty())
                        <div class="drink-wrapper">
                            <div class="pref-drink-list">
                                @foreach($favoriteDrinks as $preference)
                                    <div class="drink-block">
                                        <img src="{{ asset('images/' . $preference->alcoholType->image_path) }}"
                                            alt="{{ $preference->alcoholType->name }} Icon"
                                            class="drink-icon">
                                        <span class="drinks-name">{{ $preference->alcoholType->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="no-pref">未設定</p>
                    @endif
                </div>
                </li>
            @endforeach
        </ul>
        @endif
    </div>
    <div class="button-container">
        <a href="{{ route('account') }}" class="">プロフィールに戻る</a>
    </div>
</div>
@endsection
