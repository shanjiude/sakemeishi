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
        <label for="alcohol_strength">お酒の強さ:</label>
        <select name="alcohol_strength">
            @foreach ($strengthLabels as $value => $label)
                <option value="{{ $value }}" {{ old('alcohol_strength', $user->alcoholStrength->strength ?? 0) == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>

        <label for="soda_preference">炭酸の好み:</label>
        <select name="soda_preference">
            <option value="可" {{ old('soda_preference', $user->sodaPreference->soda_preference ?? '可') == '可' ? 'selected' : '' }}>可</option>
            <option value="不可" {{ old('soda_preference', $user->sodaPreference->soda_preference ?? '可') == '不可' ? 'selected' : '' }}>不可</option>
        </select>

        <label>好きなお酒の種類:</label>
        <div class="favorite-drinks">
            <div class="drink-tags">
                @foreach($alcoholTypes->chunk(3) as $index => $row)
                    <div class="drink-tags-row drink-tags-{{ $index + 1 }}">
                        @foreach($row as $alcohol)
                            @php
                                $preference = optional($user->alcoholPreference->firstWhere('alcohol_type_id', $alcohol->id))->preference;
                            @endphp
                            <label class="drink-option">
                                <input type="checkbox" name="alcohol_preferences[{{ $alcohol->id }}][selected]" value="1" {{ $preference ? 'checked' : '' }}>
                                <img src="{{ asset('images/' . $alcohol->image_path) }}"
                                     alt="{{ $alcohol->name }} Icon"
                                     class="sake-icon {{ $preference ? '' : 'unselected' }}">
                                <span class="drink-name">{{ $alcohol->name }}</span>
                            </label>

                            <!-- お酒の好み（ラジオボタン） -->
                            <div class="preference-options">
                                <label>
                                    <input type="radio" name="alcohol_preferences[{{ $alcohol->id }}][preference]" value="好き" {{ $preference == '好き' ? 'checked' : '' }}> 好き
                                </label>
                                <label>
                                    <input type="radio" name="alcohol_preferences[{{ $alcohol->id }}][preference]" value="普通" {{ $preference == '普通' ? 'checked' : '' }}> 普通
                                </label>
                                <label>
                                    <input type="radio" name="alcohol_preferences[{{ $alcohol->id }}][preference]" value="嫌い" {{ $preference == '嫌い' ? 'checked' : '' }}> 嫌い
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <button class="submit" type="submit">更新</button>
    </form>

    <div class="button-container">
        <a href="{{ route('account') }}">戻る</a>
    </div>
</div>
@endsection
