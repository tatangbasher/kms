<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $validated_data = $request->validate([
            'body' => 'required'
        ]);

        $validated_data['user_id'] = Auth::user()->id;
        $validated_data['post_id'] = $post->id;

        Comment::create($validated_data);

        return redirect()->route('admin.post.show', [$post->id => $post->id])->with('success', 'Komentar berhasil ditambah');
    }

    public function edit(Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);
        
        return view('admin.forum.comment.edit', [
            'title' => 'Ubah Komentar',
            'post' => Post::findOrFail($comment->post->id),
            'date' => Carbon::createFromFormat('Y-m-d', $comment->post->created_at->format('Y-m-d'))->format('d F Y'),
            'comments' => Comment::with('user')->where('post_id', $comment->post->id)->get(),
            'single_comment' => Comment::findOrFail($comment->id)
        ]);
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);

        $validated_data = $request->validate([
            'body' => 'required'
        ]);

        $validated_data['user_id'] = Auth::user()->id;
        $validated_data['post_id'] = $comment->post->id;

        Comment::where('id', $comment->id)->update($validated_data);

        return redirect()->route('admin.post.show', [$comment->post->id => $comment->post->id])->with('success', 'Komentar berhasil ditambah');
    }

    public function destroy(Comment $comment)
    {
        $comment = Comment::findOrFail($comment->id);

        Comment::destroy($comment->id);
        return redirect()->route('admin.post.show', [$comment->post->id => $comment->post->id])->with('success', 'Komentar berhasil dihapus');
    }
}
