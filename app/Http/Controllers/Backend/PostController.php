<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->latest()
            ->paginate(15);

        return view('backend.posts.index', compact('posts'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('backend.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->only('status'));

        return redirect('admin/posts')
            ->with('success', 'Post Updated Successfully');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('admin/posts')
            ->with('success', 'Post Deleted Successfully');
    }

    public function usersPosts()
    {
        $posts = Post::query()
            ->with('user')
            ->latest()
            ->paginate(15);

        return view('backend.posts.users-posts', compact('posts'));
    }
}
