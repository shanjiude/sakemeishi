<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AlcoholType;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $alcoholTypes = AlcoholType::all();
        return view('account.index', [
            'user' => $user,
            'alcoholTypes' => $alcoholTypes,
            'alcoholStrength' => $user->alcoholStrength,
            'sodaPreference' => $user->sodaPreference
        ]);
    }

    public function edit()
    {
        $user = Auth::user()->load(['alcoholStrength', 'sodaPreference']);
        $alcoholTypes = AlcoholType::all();

        return view('account.edit', [
            'user' => $user,
            'alcoholTypes' => $alcoholTypes,
            'alcoholStrength' => $user->alcoholStrength->strength ?? 0, // nullなら0を設定
            'sodaPreference' => $user->sodaPreference->preference ?? '可' // nullなら"可"を設定
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $alcoholTypes = AlcoholType::all();

        $request->validate([
            'name' => 'required|string|max:255',
            'alcohol_strength' => 'required|integer|min:0|max:5',
            'soda_preference' => 'required|in:可,不可',
            'alcohol_preferences' => 'array',
        ]);

        // usersテーブルの情報を更新
        $user->update(['name' => $request->name]);

        // お酒の強さを更新
        $user->alcoholStrength()->updateOrCreate(
            ['user_id' => $user->id],
            ['strength' => $request->alcohol_strength]
        );

        // 炭酸の可否を更新
        $user->sodaPreference()->updateOrCreate(
            ['user_id' => $user->id],
            ['preference' => $request->soda_preference]
        );

        $user->alcoholPreference()->delete();
        if ($request->has('alcohol_preferences')) {
            foreach ($request->alcohol_preferences as $alcoholTypeId => $data) {
                if (!empty($data['selected'])) {
                    $user->alcoholPreference()->create([
                        'alcohol_type_id' => $alcoholTypeId,
                        'preference' => $data['preference'] ?? '普通', // 選択なしなら "普通" をデフォルト
                    ]);
                }
            }
        }

        return redirect()->route('account')->with('success', 'プロフィールを更新しました。');
    }


    public function showOther($userId)
    {
        $user = User::findOrFail($userId); // 該当ユーザーがいなければ404
        return view('account.index', compact('user'));
    }
}

