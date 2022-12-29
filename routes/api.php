<?php

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Image;
use App\Follow;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/posts',function(){
    try{
        return Post::all();
    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
        ];
        return response()->json($mensaje);
    }
    
});

Route::get('/posts/{id}',function($id){

    try{
        $post = Post::find($id);
        return response()->json($post);

    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
        ];
        return response()->json($mensaje);
    }
    
});

Route::post('/posts',function(Request $request){


    try{
        $post = new Post();
        $id = "".$request->input('user_id');
        $description= "".$request->input('description');
        $post->user_id= $id;
        $post->description=$description;
        $post->save();
        $mensaje = [
            "mensaje"=>"Post creado exitosamente!!!"
            ];
    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
            ];
    }
    
    return response()->json($mensaje);
    
});

Route::put('/posts',function(Request $request){

    try{
        
        $id = "".$request->input('user_id');
        $description= "".$request->input('description');
        $post = Post::find($id);
        $post->description=$description;
        $post->update();
        $mensaje = [
            "mensaje"=>"Post editado exitosamente!!!"
            ];
    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
            ];
    }
    
    return response()->json($mensaje);
    
});

Route::delete('posts/{id}',function($id){
     
    try{
        Post::find($id)->delete();
        $mensaje = [
            "mensaje"=>"Post eliminado exitosamente!!!"
            ];
        
        
    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
            ];
        
    }
    return response()->json($mensaje);
});


Route::delete('comentario/{id}',function($id){
     
    try{
        Comment::find($id)->delete();
        $mensaje = [
            "mensaje"=>"Comentario eliminado exitosamente!!!"
            ];
        
        
    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
            ];
        
    }
    return response()->json($mensaje);
});


Route::post('/comentario/registrar/{id}',function($id,Request $request){


    try{
        // $validate = $this->Validate($request,[
        //     'post_id' => 'integer|required',
        //     'content' => 'string|required',
        // ]);

        $post_id = $request->input('post_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $id;
        $comment->post_id = $post_id;
        $comment->content = $content;

        $comment->save();
        
        $mensaje = [
            "mensaje"=>"Comentario registrado exitosamente!!!"
            ];
    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
            ];
    }
    
    return response()->json($mensaje);
    
});









Route::get('/imagenes',function(){
    return Image::all();
});

Route::get('/imagen-eliminar/{id}', function($id){
        try{
        //$user = \Auth::user();
        $image = Image::find($id);
        Storage::disk('images')->delete($image->image_path);
        $image->delete();
        $message = array('message'=>'La imagen fue borrada correctamente');
    }
    catch(Exception $e){
        $message = array('message'=>'Error:'.$e->getMessage());
    }
    return response()->json($message);
});




Route::post('/follow-user/{id}',function($id,Request $request){


    try{
        
        $follower_id = $request->input('follower_id');

        $follow = new Follow();
        $follow->user_id = $id;
        $follow->follower_id = $follower_id;

        $follow->save();
        
        $mensaje = [
            "mensaje"=>"Usuario seguido!!!"
            ];
    }
    catch(Exception $e){
        $mensaje = [
            "mensaje"=>"Error: ".$e->getMessage()
            ];
    }
    
    return response()->json($mensaje);
    
});