<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->only('image', 'description', 'location'), [
            'image' => 'image|mimes:jpg,png',
            'description' => 'string',
            'location' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $post = Post::create([
            'description' => $request->description,
            'location' => $request->location,
            'user_id' => Auth::user()->id
        ]);

        $result = cloudinary()->upload()

        $image = new Image([
            'public_image_id' => $result->getPublicId(),
            'image_url' => $result->getSecurePath()
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
        ]);

    }

}
