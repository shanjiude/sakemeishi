@extends('layouts.main')

@section('content')
<div class="container">
    <div class="profile-header">
        <img src="{{ asset('images/default_icon.png') }}" alt="User Icon" class="profile-icon">
        <h2 class="user-name">{{ Auth::user()->name }}</h2>
    </div>

    <div>
    <p>お酒の強さ: ★★★★☆</p>
    </div>

    <div class="favorite-drinks">
        <h3>好きなお酒の種類</h3>
        <div class="drink-tags">
            <span>🍺 ビール</span>
            <span>🍷 ワイン</span>
            <span>🥃 ウイスキー</span>
        </div>
    </div>

    <div class="drink-list">
        <h3>飲んだお酒リスト</h3>
        <ul>
            <li>🍶 獺祭（Dassai） - 旭酒造</li>
            <li>🍸 カクテル XYZ - バーオリジナル</li>
            <li>🍺 プレミアムモルツ - サントリー</li>
        </ul>
    </div>
    <div class="profile-edit-button">
        <a href="#">プロフィール編集</a>
    </div>
</div>
@endsection
