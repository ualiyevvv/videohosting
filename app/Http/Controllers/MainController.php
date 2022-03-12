<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(Request $request)
    {
        if($request->search){
            $videos = Video::where('strike_id', 1)
                ->join('categories','category_id','=','categories.id')
                ->join('users','user_id','=','users.id')
                ->orWhere('caption','like','%'.$request->search.'%')
                ->orWhere('description','like','%'.$request->search.'%')
                ->orWhere('cat_name','like','%'.$request->search.'%')
                ->orWhere('nickname','like','%'.$request->search.'%')
                ->orderBy('videos.created_at','desc')
                ->select('videos.id', 'caption', 'videos.views', 'videos.created_at', 'cat_name', 'nickname')
                ->paginate(10);
            return view('main',compact('videos'));
        }

        $videos = Video::where('videos.strike_id', 1)
            ->with('category')
            ->with('user')
            ->orderBy('videos.created_at','desc')
            ->paginate(10);
        //dd($request->ip());
        //dd($request->session());
        //dd(Auth::getName());
        
        return view('main', compact('videos'));
    }
    public function myVideos($nickname)
    {
        $user = User::where('users.nickname', $nickname)->get();
        $videos = Video::where('videos.user_id', $user[0]['id'])
        ->with('strike')
        ->where('videos.strike_id', '<', 4)
        ->orderBy('videos.created_at','desc')
        ->get();

        // dd($videos[0]->strike_id);
        return view('my-videos', compact('videos'));
        //
    }
    //
}
