<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user', function(){
    global $users;
    return $users;
});

Route::get('/user/{userIndex}', function($userIndex){
    global $users;
    if (isset($users[$userIndex])){
        return $users[$userIndex];
    }
    else {
        return "Can not find user index " . $userIndex;
    }
})->whereNumber('userIndex');

Route::get('/user/{userName}', function($userName){
    global $users;
    foreach ($users as $user){
        if ($userName == $user['name']){
            return $user;
        }
        else{
            return "cannot find this user ". $userName;
        }
    }
   
})->whereAlpha('userName');