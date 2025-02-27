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
        $user = Auth::user();
        if (!$user) {
            abort(403, 'ログインしてください');
        }

        // フォローしているユーザーを取得（お酒の好みも取得）
        $follows = $user->friend()->with('friend.alcoholPreference.alcoholType')->get()->pluck('friend');

        return view('followlist.index', ['follows' => $follows]);
    }

}
