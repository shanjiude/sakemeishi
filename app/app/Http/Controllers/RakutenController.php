<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\FavoriteDrink;
use Illuminate\Support\Facades\Auth;

class RakutenController extends Controller
{
    public function search(Request $request)
    {
        $user = Auth::user();
        $recentDrinks = $user->favoriteDrinks()->latest()->take(3)->get();
        $apiKey = config('services.rakuten.application_id'); // APIキー取得
        $keyword = $request->input('keyword', ''); // ユーザー入力の検索ワード

        // ビール・洋酒の検索
        $response1 = Http::get('https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706', [
            'format' => 'json',
            'applicationId' => $apiKey,
            'genreId' => 510915, // ビール・洋酒
            'keyword' => $keyword,
            'hits' => 3, // 取得件数
        ]);

        // 日本酒・焼酎の検索
        $response2 = Http::get('https://app.rakuten.co.jp/services/api/IchibaItem/Search/20170706', [
            'format' => 'json',
            'applicationId' => $apiKey,
            'genreId' => 510901, // 日本酒・焼酎
            'keyword' => $keyword,
            'hits' => 2, // 取得件数
        ]);

        // レスポンスをマージ
        $items1 = $response1->json()['Items'] ?? [];
        $items2 = $response2->json()['Items'] ?? [];
        $items = array_merge($items1, $items2); // 両方の結果を結合

        return view('rakuten.search', compact('items', 'keyword', 'recentDrinks'));
    }


    public function saveFavorite(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image_url' => 'required|url',
            'product_url' => 'required|url',
        ]);

        FavoriteDrink::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'image_url' => $request->image_url,
            'product_url' => $request->product_url,
        ]);

        return redirect()->back()->with('success', 'お気に入りに追加しました！');
    }

    public function destroy($id)
    {
        $drink = Auth::user()->favoriteDrinks()->find($id);

        if ($drink) {
            $drink->delete();
            return redirect()->back()->with('success', '削除しました！');
        }

        return redirect()->back()->with('error', '削除できませんでした。');
    }
}
