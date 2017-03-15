<?php

use Illuminate\Http\Request;
use App\Todo;

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

Route::middleware('cors:api')->get('/todos', function (){
    $todos = Todo::all();

    return $todos;
});

Route::middleware('cors', 'api')->get('/todo/{id}', function ($id){
    $todo = Todo::find($id);

    return $todo;
});

Route::middleware('cors', 'api')->post('/todo/create', function (Request $request){
    $data = ['title' => $request->get('title'), 'completed' => 0];
    $todo = Todo::create($data);

    return $todo;
});

Route::middleware('cors', 'api')->patch('/todo/{id}/completed', function ($id){
    $todo = Todo::find($id);
    $todo->completed = !$todo->completed;
    $todo->save();

    return $todo;
});

Route::middleware('cors', 'api')->delete('/todo/{id}/delete', function ($id){
    $todo = Todo::find($id);
    $todo->delete();

    return response()->json(['deleted successfully']);
});


