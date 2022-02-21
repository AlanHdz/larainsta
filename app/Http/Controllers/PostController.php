<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function store(Request $request) : JsonResponse
    {

        $validator = Validator::make($request->only('image', 'description', 'location'), [
            'image' => 'image|mimes:jpg,png|required',
            'description' => 'string',
            'location' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

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

    public function delete(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(['message' => 'Post not found'], 404);
        }

        if (Auth::user()->id != $post->user_id) {
            return response()->json(['message' => 'Do you not have access'], 403);
        }

        $post->images()->delete();

        $post->delete();

        return response()->json(['message' => 'Post deleted succesfully'], 200);
    }

}
