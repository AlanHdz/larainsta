<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FriendshipController extends Controller
{

    public function followUser($id)
    {
        $user = Auth::user();

        $userFollow = User::where('id', $id);

        if (!$userFollow->exists()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (Gate::forUser($user)->denies('auto-follow-and-unfollow-user', $userFollow->first())) {
            return response()->json(['message' => 'Do you not have access'], 403);
        }

        $user->following()->attach($id);

        return response()->json(['status' => 'ok'], 200);

    }

    public function unfollowUser($id)
    {
        $user = Auth::user();

        $userFollow = User::where('id', $id);

        if (!$userFollow->exists()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (Gate::forUser($user)->denies('auto-follow-and-unfollow-user', $userFollow->first())) {
            return response()->json(['message' => 'Do you not have access'], 403);
        }

        $user->following()->dettach($id);

        return response()->json(['status' => 'ok'], 200);
    }

}
