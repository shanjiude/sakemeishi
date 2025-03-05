@extends('layouts.main')
@section('title', '飲んだお酒登録')

@section('content')
<div class="container">
    <div class="drink-list">
        <h3>最近飲んだお酒</h3>
        <div class="drink-list">
        <ul>
            @forelse ($recentDrinks as $drink)
                <li>
                    <img src="{{ $drink->image_url ?: asset('images/beer.png') }}" alt="{{ $drink->name }}" class="sake-icon">
                    <span class="sake-name">{{ $drink->name }}</span>
                    <form action="{{ route('rakuten.destroy', $drink->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('削除しますか？');" class="delete-btn">削除</button>
                    </form>
                </li>
            @empty
                <li>登録されていません</li>
            @endforelse
        </ul>
        </div>
    </div>
    <h2 class="mt-4">楽天市場からお酒を検索</h2>

    <form action="{{ route('rakuten.search') }}" method="GET">
        <input type="text" name="keyword" placeholder="お酒の名前を入力" value="{{ old('keyword') }}" required>
        <button type="submit" class="search-button">検索</button>
    </form>

    @if(!empty($items))
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
    <div class="other-container">
        <div class="button-container">
            <a href="{{ route('account') }}">戻る</a>
        </div>
    </div>
</div>
@endsection
