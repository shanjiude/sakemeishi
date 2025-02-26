<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Friend;

class FollowlistController extends Controller
{
    public function index()
{
    $user = Auth::user(); // ログインユーザーを取得
    if (!$user) {
        abort(403, 'ログインしてください'); // ユーザーが未ログインの場合の処理
    }

    // フォローしているユーザーを取得
    $follows = $user->friend()->with('friend')->get()->pluck('friend');
// 1.$user->friend() で、ログインしているユーザーが関わるフォロー関係のレコード（Friend モデル）を取得します。
// 2.with('friend') で、各 Friend レコードの friend_id に関連するユーザー情報（フォローされているユーザー）を同時に取得します。
// 3.get() でその結果を取得し、フォロー関係のレコードをコレクションとして取得します。
// 4.pluck('friend') で、Friend レコードから friend（フォローされているユーザー）を取り出して、新しいコレクションにします。

    return view('followlist.index', ['follows' => $follows]); // ビューへデータを渡す
}


}
