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
Route::prefix('/user') -> group(function(){
    Route::get('/', function(){
        global $users;
        return $users;
    });
    Route::get('/{userIndex}', function($userIndex){
        global $users;
        if (isset($users[$userIndex])){
            return $users[$userIndex];
        }
        else {
            return "Can not find user index " . $userIndex;
        }
    })->whereNumber('userIndex');
    Route::get('/{userName}', function($userName){
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
    Route::fallback(function(){
        return "You cannot get user like this";
    });
    Route::get('/{userIndex}/post/{postIndex}', function($userIndex, $postIndex){
        global $users;
        if (isset($users[$userIndex])){
            $user = $users[$userIndex];
            if (isset($user['posts'][$postIndex])){
                return $user['posts'][$postIndex];
            }
            else {
                return "Cannot find post with index " . $postIndex . "for user with index " . $userIndex;
            }
        }
        else{
            return "Cannot find user with index " . $userIndex;
        }
    })->whereNumber(['userIndex', 'postIndex']);
});






