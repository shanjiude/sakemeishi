@extends('layouts.main')

@section('content')
<div class="container">
    <h2>楽天市場からお酒を検索</h2>

    <form action="{{ route('rakuten.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="お酒の名前を入力" value="{{ old('keyword') }}" required>
        <button type="submit" class="search-button">検索</button>
    </form>

    @if(!empty($items))
        <h3>検索結果</h3>
        <ul>
            @foreach($items as $item)
                <li class="search-drink-list">
                    <a href="{{ $item['Item']['itemUrl'] }}" target="_blank">
                        <img src="{{ $item['Item']['mediumImageUrls'][0]['imageUrl'] }}" alt="{{ $item['Item']['itemName'] }}">
                        <p>{{ $item['Item']['itemName'] }}</p>
                    </a>
                    <form action="{{ route('rakuten.save') }}" method="POST">
                        @csrf
                        <input type="hidden" name="name" value="{{ $item['Item']['itemName'] }}">
                        <input type="hidden" name="image_url" value="{{ $item['Item']['mediumImageUrls'][0]['imageUrl'] }}">
                        <input type="hidden" name="product_url" value="{{ $item['Item']['itemUrl'] }}">
                        <button type="submit" class="add-favorite">お気に入りに追加</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
</div>
<div class="other-container">
    <div class="top-back">
        <a href="{{ route('account') }}">戻る</a>
    </div>
</div>
@endsection
