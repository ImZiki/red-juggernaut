<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get();
        return view('pages.admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('pages.admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:102400',
        ], [
            'title.required' => 'El título es obligatorio.',
            'content.required' => 'El contenido es obligatorio.',
            'image.image' => 'El archivo debe ser una imagen válida.',
            'image.max' => 'La imagen no debe superar los 100MB.',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        // Crear el post
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        if ($imagePath) {
            $post->images()->create([
                'filename' => basename($imagePath),
            ]);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post creado correctamente.');
    }


    public function edit(Post $post)
    {
        return view('pages.admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ], [
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no puede tener más de 255 caracteres.',
            'content.required' => 'El contenido es obligatorio.',
        ]);

        $data = $request->only(['title', 'content']);

        // Actualizar imagen si se sube una nueva
        if ($request->hasFile('image')) {
            // Borrar imagen anterior si existe
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            $data['image'] = $request->file('image')->store('media', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post actualizado correctamente.');
    }

    public function destroy(Post $post)
    {
        // Borrar imagen si existe
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post eliminado correctamente.');
    }
}
