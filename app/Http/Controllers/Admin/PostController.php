<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    
    public function index()
    {
        return view('admin.forum.index', [
            'title' => 'Daftar Diskusi',
            'posts' => Post::with('comments')->latest()->filter(request(['search']))->paginate(5)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('admin.forum.create', [
            'title' => 'Diskusi Baru'
        ]);
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $validated_data['user_id'] = Auth::user()->id;

        Post::create($validated_data);

        return redirect('admin/forum')->with('success', 'Data berhasil ditambah');
    }

    public function show(Post $post)
    {
        $post = Post::findOrFail($post->id);
        
        return view('admin.forum.show', [
            'title' => 'Diskusi - ' . $post->title,
            'post' => $post,
            'date' => Carbon::createFromFormat('Y-m-d', $post->created_at->format('Y-m-d'))->format('d F Y'),
            'comments' => Comment::where('post_id', $post->id)->get()
        ]);
    }

    public function edit(Post $post)
    {
        return view('admin.forum.edit', [
            'title' => 'Ubah Data Diskusi',
            'post' => $post
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validated_data = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $validated_data['user_id'] = Auth::user()->id;

        Post::where('id', $post->id)->update($validated_data);

        return redirect('admin/forum')->with('success', 'Data berhasil diubah');
    }

    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        return redirect('admin/forum')->with('success', 'Data telah dihapus!');
    }
}
