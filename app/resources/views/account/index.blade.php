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
            <p>お酒の強さ: ★★★★☆</p>
            <p>炭酸の可否: 可</p>
        </div>
        </div>
    </div>

    <div class="user-id">
        <p>ID : {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }}</p>
    </div>

    <div class="favorite-drinks">
        <h3>好きなお酒の種類</h3>
        <div class="drink-tags-1">
            <img src="{{ asset('images/beer.png') }}" alt="beer Icon" class="sake-icon">
            <img src="{{ asset('images/syouchu.png') }}" alt="syouchu Icon" class="sake-icon">
            <img src="{{ asset('images/whisky.png') }}" alt="whisky Icon" class="sake-icon">
        </div>
        <div class="drink-tags-2">
            <img src="{{ asset('images/nihonsyu.png') }}" alt="nihonsyu Icon" class="sake-icon">
            <img src="{{ asset('images/wine.png') }}" alt="redwine Icon" class="sake-icon">
            <img src="{{ asset('images/white_wine.png') }}" alt="whitewine Icon" class="sake-icon">
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
        <a href="#">ID検索</a>
    </div>
    </div>
</div>
@endsection
