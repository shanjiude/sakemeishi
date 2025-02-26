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
        $recentDrinks = $user->favoriteDrinks()->latest()->take(3)->get();
        $alcoholTypes = AlcoholType::all();
        return view('account.index', [
            'user' => $user,
            'alcoholTypes' => $alcoholTypes,
            'alcoholStrength' => $user->alcoholStrength,
            'sodaPreference' => $user->sodaPreference,
            'recentDrinks' => $recentDrinks,
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
            ['soda_preference' => $request->soda_preference]
        );

        $user->alcoholPreference()->delete();
        if ($request->has('alcohol_preferences')) {
            foreach ($request->alcohol_preferences as $alcoholTypeId => $data) {
                $user->alcoholPreference()->updateOrCreate(
                    ['user_id' => $user->id, 'alcohol_type_id' => $alcoholTypeId],
                    ['preference' => $data['preference'] ?? '普通']
                );
            }
        }

        return redirect()->route('account')->with('success', 'プロフィールを更新しました。');
    }


    public function showOther($userId)
    {
        $user = User::findOrFail($userId); // 表示対象のユーザーを取得
        $alcoholTypes = AlcoholType::all();

        return view('account.other', [
            'user' => $user,
            'alcoholTypes' => $alcoholTypes,
            'alcoholStrength' => $user->alcoholStrength, // 指定ユーザーの alcoholStrength
            'sodaPreference' => $user->sodaPreference, // 指定ユーザーの sodaPreference
            'recentDrinks' => $user->favoriteDrinks()->latest()->take(3)->get(), // 指定ユーザーの最近飲んだお酒
        ]);
    }

    public function searchForm()
    {
        return view('account.search');
    }

    public function search(Request $request)
    {
        $request->validate([
            'user_id' => 'required|digits:5', // 5桁の数字
        ]);

        $userId = ltrim($request->input('user_id'), '0'); // 00002 → 2 に変換
        $user = User::where('id', $userId)->first();

        return view('account.search', compact('user'));
    }
}

