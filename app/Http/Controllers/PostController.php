<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index', [
            'posts' => Post::where('user_id', Auth::id())->get()
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function show($id)
    {
        return view('post.show', [
            'post' => Post::find($id)
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'date' => 'required|date'
        ]);

        try {
            DB::beginTransaction();
            Post::create([
                'title' => $payload['title'],
                'content' => $payload['content'],
                'date' => $payload['date'],
                'user_id' => Auth::id()
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('post.index')->withSuccess('simpan data berhasil');
    }

    public function update(Request $request, $id)
    {
        $payload = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'date' => 'required|date'
        ]);

        $post = Post::find($id);

        try {
            DB::beginTransaction();
            $post->update([
                'title' => $payload['title'],
                'content' => $payload['content'],
                'date' => $payload['date'],
            ]);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('post.index')->withSuccess('ubah data berhasil');
    }
}
