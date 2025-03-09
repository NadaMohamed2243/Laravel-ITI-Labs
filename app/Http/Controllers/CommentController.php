<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $content = request()->content;
        $commentable_type = request()->commentable_type;
        $commentable_id = request()->commentable_id;

        $comment = Comment::create(["content" => $content, 'commentable_type' => $commentable_type, 'commentable_id' => $commentable_id]);

        return to_route('posts.show', $comment->commentable_id);
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }

    public function update($id)
    {

        $comment = Comment::find($id);

        $content = request()->content;

        $comment->update([
            'content' => $content
        ]);

        return to_route('posts.show', $comment->commentable_id);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}