@extends('layouts.main')

@section('content')
<div class="container">
    <div class="user-id">
        <p>ID : {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
    </div>
    <div class="profile-header">
        <div class="user-head">
            <div class="user-icon-container flex flex-col items-center">
            <img src="{{ asset('images/default_icon.png') }}" alt="User Icon" class="profile-icon">
            <h2 class="user-name">{{ $user->name }}</h2>
            </div>
            <div class="follow-container">
                <button id="follow-btn"
                        data-user-id="{{ $user->id }}"
                        class="px-2 py-2 bg-blue-500 text-white rounded">
                    {{ Auth::user()->isFollowing($user->id) ? 'フォロー解除' : 'フォロー' }}
                </button>
            </div>
        </div>
        <div class="user-others">
        <div class="alcohol-strength">
            @php
                    $strengthLabels = [
                    0 => '全く飲めない',
                    1 => 'ほぼ飲めない',
                    2 => '弱い',
                    3 => '普通',
                    4 => '強い',
                    5 => '酒豪',
                ];
            @endphp
            @if(isset($user->alcoholStrength->strength))
            @php $strength = $user->alcoholStrength->strength; @endphp
            <p>お酒の強さ: {{ $strengthLabels[$strength] }}</p>
            <div class="alcohol-icons">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-beer" style="color: {{ $i <= $strength ? 'gold' : 'gray' }};"></i>
                @endfor
                </div>
            @else
                <p>お酒の強さ: 登録されていません</p>
            @endif
            <p>炭酸の好み: {{ $user->sodaPreference->soda_preference ?? '登録されていません'  }}</p>
        </div>
        </div>
    </div>

    <div class="favorite-drinks">
        <h3>好きなお酒の種類</h3>
        <div class="favorite-drinks">
            <div class="drink-tags">
                <div class="drink-fav-list">
                    @foreach($user->alcoholPreference as $preference)
                        @if ($preference->preference === '好き' && $preference->alcoholType)
                            <div class="drink-item">
                                <img src="{{ asset('images/' . $preference->alcoholType->image_path) }}"
                                     alt="{{ $preference->alcoholType->name }} Icon"
                                     class="sake-icon">
                                <span class="drink-name">{{ $preference->alcoholType->name }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="drink-list">
        <h3>最近飲んだお酒</h3>
        <ul>
            @forelse ($recentDrinks as $drink)
                <li>
                    <img src="{{ $drink->image_url ?: asset('images/beer.png') }}" alt="{{ $drink->name }}" class="sake-icon">
                    <span class="sake-name">{{ $drink->name }}</span>
                </li>
            @empty
                <li>登録されていません</li>
            @endforelse
        </ul>
    </div>
    <div class="other-container">
        <div class="top-back">
            <a href="{{ route('followlist.index') }}">知り合い一覧へ</a>
        </div>
        <div class="top-back">
            <a href="{{ route('account') }}">戻る</a>
        </div>
    </div>
</div>
@endsection
