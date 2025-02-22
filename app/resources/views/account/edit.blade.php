@extends('layouts.main')

@section('content')
<div class="container">
    <h2>プロフィール編集</h2>

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('account.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="name">名前:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">

        <label for="alcohol_strength">お酒の強さ:</label>
        <select name="alcohol_strength">
            @for ($i = 0; $i <= 5; $i++)
                <option value="{{ $i }}" {{ old('alcohol_strength', $user->alcoholStrength->strength ?? 0) == $i ? 'selected' : '' }}>
                    {{ $i }}
                </option>
            @endfor
        </select>

        <label for="soda_preference">炭酸の可否:</label>
        <select name="soda_preference">
            <option value="可" {{ old('soda_preference', $user->sodaPreference->preference ?? '可') == '可' ? 'selected' : '' }}>可</option>
            <option value="不可" {{ old('soda_preference', $user->sodaPreference->preference ?? '可') == '不可' ? 'selected' : '' }}>不可</option>
        </select>

        <button class="submit" type="submit">更新</button>
    </form>

    <div class="button-container">
        <a href="{{ route('account') }}">戻る</a>
    </div>
</div>
@endsection
