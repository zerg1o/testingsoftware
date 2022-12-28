<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;

class FollowController extends Controller
{
    //

    public function save(int $user_id){
        $follow = \Auth::user();

        if($user_id != ''){
            $follower_id = $follow->id;
            $follow_user = new Follow();
            $follow_user->user_id = $user_id;
            $follow_user->follower_id = $follower_id;

            $follow_user->save();
            return redirect()->back()->with(['message'=>'Usuario seguido!']);
        }
    }
}
