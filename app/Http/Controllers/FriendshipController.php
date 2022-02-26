<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{

    public function followUser($id)
    {
        $user = Auth::user();

        if (!User::where('id', $id)->exists()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->following()->attach($id);

        return response()->json(['status' => 'ok'], 200);

    }

    public function unfollowUser($id)
    {
        $user = Auth::user();

        if (!User::where('id', $id)->exists()) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->following()->dettach($id);

        return response()->json(['status' => 'ok'], 200);
    }

}
