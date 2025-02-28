@extends('layouts.main')
@section('title', 'プロフィール')

@section('content')
<div class="container">
    <div class="user-id">
        <p>ID : {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
    </div>
    <div class="profile-header">
        <div class="user-head">
            <div class="user-icon-container flex flex-col items-center">
                <img src="{{ asset($user->profile_picture ?? 'images/default_icon.png') }}" alt="User Icon" class="profile-icon">
                <h2 class="user-name">{{ $user->name }}</h2>
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
            <p>ひとこと: {{ $user->bio->bio ?? '未設定' }}</p>
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
        <div class="drink-list">
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
    </div>
    <div class="other-container">
    <div class="profile-edit">
        <a href="{{ route('account.edit') }}">プロフィール編集</a>
    </div>
    <div class="ID-search">
        <a href="{{ route('account.search') }}">ID検索</a>
    </div>
    <div class="ID-search">
        <a href="{{ route('rakuten.search') }}">最近飲んだお酒の登録</a>
    </div>
    <div class="go-followlist">
        <a href="{{ route('followlist.index') }}">フォロー一覧</a>
    </div>
    <div class="logout-container">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">ログアウト</button>
        </form>
    </div>
    </div>
</div>
@endsection
