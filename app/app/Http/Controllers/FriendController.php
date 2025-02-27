<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Friend;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function toggleFollow($friendId)
    {
        $user = Auth::user();
        $isFollowing = $user->isFollowing($friendId);

        if ($isFollowing) {
            // 既にフォローしている場合は解除
            Friend::where('user_id', $user->id)
                ->where('friend_id', $friendId)
                ->delete();
        } else {
            // フォローしていない場合は追加
            Friend::create([
                'user_id' => $user->id,
                'friend_id' => $friendId,
            ]);
        }

        return response()->json(['following' => !$isFollowing]);
    }
}
