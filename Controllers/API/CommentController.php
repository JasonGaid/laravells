<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Find the post
        $post = Post::find($postId);

        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        // Create the comment
        $comment = new Comment();
        $comment->post_id = $request->input('post_id');
        $comment->content = $request->input('content');
        $comment->user_id = $request->input('user_id');

        // Save the comment
        $post->comments()->save($comment);

        return response()->json(['message' => 'Comment added successfully'], 201);
    }
}
