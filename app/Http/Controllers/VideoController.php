<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Strike;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::with('category')
            ->with('user')
            ->with('strike')
            ->orderBy('videos.created_at','desc')
            ->paginate(10);

        return view('admin.video', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('addVideo', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:mp4',
            'category_id' => 'required',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['strike_id'] = 1;
        if($request->hasFile('file'))
        {
            $folder = date('Y-m-d');
            $path = $request->file('file')->store("uploads/{$folder}", 'public');
            $url = Storage::url($path);
            $data['file'] = $url;
        }
        $video = Video::create($data);

        return redirect()->route('video.show', ['id'=>$video->id])->with('success', 'Видео добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::where('id', $id)
            ->with('category')
            ->with('user')
            ->first();
        
        if(!$video)
        {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }
        if(($video['strike_id'] == 2 or $video['strike_id'] == 4) && Auth::user()->is_admin != 1)
        {
            return redirect()->route('home')->withErrors('Видео недоступно');
        }
        
        $comments = Comment::where('video_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
                
        $video->increment('views');

        return view('video-show', compact('video', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::where('id', $id)
            ->with('category')
            ->with('user')
            ->first();
            
        if (!$video)
        {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }

        $categories = Category::all();

        return view('video.edit', compact('video', 'categories'));
    }

    public function adminEdit($id)
    {
        $video = Video::where('id', $id)
            ->with('category')
            ->with('user')
            ->with('strike')
            ->first();

        if (!$video)
        {
            return  redirect()->route('home')->withErrors('Вы куда-то не туда');
        }

        $categories = Category::all();
        $strikes = Strike::all();

        return view('admin.video-edit', compact('video', 'categories', 'strikes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'caption' => 'required',
            'description' => 'required',
            'category_id' => 'required'
        ]);

        $video = Video::find($id);
        $video->update($request->all());

        return redirect()->route('video.show',['id'=>$id])->with('success', 'Видео отредактировано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $video = Video::find($id);
        if ($video->id)
        {
            $video->increment('likes');
            return redirect()->route('video.show',['id'=>$id])->with('success', 'Видео likes');
        }
        else
        {
            return  redirect()->back()->withErrors('Вы куда-то не туда');
        }
    }
    public function dislike($id)
    {
        $video = Video::find($id);
        if ($video->id)
        {
            $video->increment('dislikes');
            return redirect()->route('video.show',['id'=>$id])->with('success', 'Видео likes');
        }
        else
        {
            return  redirect()->back()->withErrors('Вы куда-то не туда');
        }
    }

    public function destroy($id)
    {
        $video = Video::find($id);
        if(!$video)
        {
            return  redirect()->back()->withErrors('Вы куда-то не туда');
        }
        $video->delete();

        return redirect()->back()->with('success', 'Видео удалено');
    }

    
}
