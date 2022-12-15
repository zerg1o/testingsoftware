<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Like;
use App\Post;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    
    public function index(){
        $user = \Auth::user();
        $likes = Like::where('user_id',$user->id)->orderBy('id','desc')
                            ->paginate(5);
        return view('like.index',['likes'=>$likes]);
    }



    public function getlikepost($post_id){
        $post = Post::find($post_id);

        if($post){
            return response()->json([
                'likes'=>$post->likes
            ]);
        }else{
            return response()->json([
                'message'=>'post no existe'
            ]);
        }
    }

    public function like($post_id){
        //recoger datos del usuario e imagen
        $user = \Auth::user();
        $like = new Like();

        $like->user_id = $user->id;
        $like->post_id = (int) $post_id;

        //verificar si el usuario ya dio like a la imagen
        $like_exist = Like::where('user_id',$user->id)
                        ->where('post_id',$post_id)->first();

        if($like_exist==null){
            //guardar
            $like->save();
            return response()->json([
                'like'=>$like,
                'message'=>'1'
            ]);
        }else{
            $like_exist->delete();
            return response()->json([
                'like'=>$like_exist,
                'message'=>'0'
            ]);
        }

    }

    // public function like($post_id){
    //     //recoger datos del usuario e imagen
    //     $user = \Auth::user();
    //     $like = new Like();

    //     $like->user_id = $user->id;
    //     $like->post_id = (int) $post_id;

    //     //verificar si el usuario ya dio like a la imagen
    //     $verify = Like::where('user_id',$user->id)
    //                     ->where('post_id',$post_id)->count();

    //     if($verify == 0){
    //         //guardar
    //         $like->save();
    //         return response()->json([
    //             'like'=>$like
    //         ]);
    //     }else{
    //         return response()->json([
    //             'message'=>'El like ya existe'
    //         ]);
    //     }



    // }

    // public function dislike($post_id){
    //     //recoger datos del usuario e imagen
    //     $user = \Auth::user();


    //     //verificar si el usuario ya dio like a la imagen
    //     $like = Like::where('user_id',$user->id)
    //                     ->where('post_id',$post_id)->first();

    //     if($like){
    //         //guardar
    //         $like->delete();
    //         return response()->json([
    //             'like'=>$like,
    //             'message'=>'Has dado dislike'
    //         ]);
    //     }else{
    //         return response()->json([
    //             'message'=>'El like no existe'
    //         ]);
    //     }
    // }
}
