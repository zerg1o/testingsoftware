<?php

use Illuminate\Http\Request;
use App\Post;
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



