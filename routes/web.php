<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::post('/login', [LoginController::class, 'authenticated']);
Auth::routes(['reset' => false]);

Route::middleware('auth')->get('/user', function (Request $request) {
    $user = $request->user();
    $user->permissionList = $request->user()->getPermissionNames()->toArray();
    return response()->json(["id" => $user->id, "name" => $user->name, "email" => $user->email, "permissions" => $user->permissionList], 200);
});

Route::get('/{any?}', function () {
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');
