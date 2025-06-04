<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\YoutubeService;
use Illuminate\Http\Request;

class OpsController extends Controller
{
    protected YoutubeService $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    public function index(Request $request)
    {
        // ID del canal de YouTube que quieres mostrar
        $channelId = 'UCdsJfMQjPg0W--sAEl7gzpA';

        // Obtener videos (ajusta el número según necesites)
        $videos = $this->youtubeService->getChannelVideos($channelId, 5);
        $posts = Post::with('images', 'user')->latest()->paginate(9);

        // Pasar datos a la vista
        return view('pages.ops.index', compact('videos', 'posts'));
    }
    public function show(Post $post)
    {
        $post->loadMissing('images', 'user');
        return view('pages.ops.show', compact('post'));
    }

}
