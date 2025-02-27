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

                    @php
                        // "好き" のお酒だけをフィルタリング
                        $favoriteDrinks = $follow->alcoholPreference->filter(function ($preference) {
                            return $preference->preference === '好き' && $preference->alcoholType;
                        });
                    @endphp

                    <!-- 好きなお酒が1つ以上ある場合のみ表示 -->
                    @if ($favoriteDrinks->isNotEmpty())
                        <div class="favorite-drinks">
                            <p class="drink-label">お酒の好み</p>
                            <div class="drink-list">
                                @foreach($favoriteDrinks as $preference)
                                    <div class="drink-item">
                                        <img src="{{ asset('images/' . $preference->alcoholType->image_path) }}"
                                             alt="{{ $preference->alcoholType->name }} Icon"
                                             class="sake-icon">
                                        <span class="drink-name">{{ $preference->alcoholType->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="not-set">お酒の好み: 未設定</p>
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



