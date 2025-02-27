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
                    <a href="{{ route('account.showOther', $follow->id) }}" class="followlist-to-otherprofile">
                        <img class="follow-user-icon" src="{{ asset($follow->profile_picture) }}" alt="Profile Picture" width="50" height="50">
                        <p>{{ $follow->name }}</p>
                    </a>

                    @php
                        // "好き" のお酒だけをフィルタリング
                        $favoriteDrinks = $follow->alcoholPreference->filter(function ($preference) {
                            return $preference->preference === '好き' && $preference->alcoholType;
                        });
                    @endphp

                    <!-- 好きなお酒が1つ以上ある場合のみ表示 -->
                    @if ($favoriteDrinks->isNotEmpty())
                    <div class="follow-favorite-drinks">
                        <p class="pref-drink-label">お酒の好み：</p>
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
                    </div>
                    @else
                        <p class="pref-drink-label">お酒の好み: 未設定</p>
                    @endif
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
