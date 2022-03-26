<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\DeletePostRequest;
use App\Http\Requests\Posts\PostRequest;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function store(PostRequest $request) : JsonResponse
    {
        $result = cloudinary()->upload($request->file('image')->getRealPath(), [
            'folder' => Auth::user()->username,
            'transformation' => [
                'quality' => "auto",
                'fetch_format' => "auto"
            ]
        ]);

        $image = new Image([
            'public_image_id' => $result->getPublicId(),
            'image_url' => $result->getSecurePath()
        ]);

        $post = Post::create([
            'description' => $request->description,
            'location' => $request->location,
            'user_id' => Auth::user()->id
        ]);

        $post->images()->save($image);

        return response()->json([
            'message' => 'Post created successfully',
            'post' => [
                'id' => $post->id,
                'description' => $post->description,
                'location' => $post->location,
                'image' => [
                    'id' => $image->id,
                    'public_image_id' => $image->public_image_id,
                    'image_url' => $image->image_url
                ]
            ]
        ], 200);

    }

    public function delete(DeletePostRequest $request, $id) : JsonResponse
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        $post->images()->delete();

        $post->delete();

        return response()->json(['message' => 'Post deleted succesfully'], 200);
    }

}
