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

        $follows = $user->friend()->get(); // ユーザーのフォローリストを取得
        return view('account.followlist', ['follows' => $follows]); // ビューへデータを渡す
    }

}
