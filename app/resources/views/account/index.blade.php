@extends('layouts.main')

@section('content')
<div class="container">
    <div class="profile-header">
        <div class="user-head">
        <img src="{{ asset('images/default_icon.png') }}" alt="User Icon" class="profile-icon">
        </div>
        <h2 class="user-name">{{ $user->name }}</h2>
        <div class="user-others">
        <div class="alcohol-strength">
            <p>お酒の強さ: {{ $user->alcoholStrength->strength ?? '登録されていません'  }}</p>
            <p>炭酸の可否: {{ $user->sodaPreference->soda_preference ?? '登録されていません'  }}</p>
        </div>
        </div>
    </div>

    <div class="user-id">
        <p>ID : {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
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
            <li>🍶 獺祭（Dassai） - 旭酒造</li>
            <li>🍸 カクテル XYZ - バーオリジナル</li>
            <li>🍺 プレミアムモルツ - サントリー</li>
        </ul>
    </div>
    <div class="other-container">
    <div class="profile-edit">
        <a href="{{ route('account.edit') }}">プロフィール編集</a>
    </div>
    <div class="ID-search">
        <a href="{{ route('account.search') }}">ID検索</a>
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
