<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{

    public function getFeed()
    {
        $userIds = Auth::user()->following()->get()->pluck('id');
        $posts = Post::whereIn('user_id', $userIds)
            ->select(['posts.id', 'posts.description', 'posts.location', 'posts.user_id', 'posts.created_at'])
            ->with([
                'user' => function (Builder $query) {
                    $query->select(['users.username', 'users.id']);
                }, 
                'images' => function (Builder $query) {
                    $query->select(['images.id', 'images.public_image_id', 'images.post_id']);
                }])
            ->latest()->get();
        
        return response()->json(['posts' => $posts], 200);
        
    }

}
