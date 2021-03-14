<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostAdminController;
use App\Http\Controllers\DiscordAuthController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PostController::class, 'index']);

Route::get('/auth', function() {

    if(Auth::attempt(['email'=>'fahey.dahlia@example.net', 'password'=>$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi])) {
        return "Oi";
    }

    return "Falhou";
});

Route::get('/auth/logout', function(){
    Auth::logout();
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function() {
    Route::get('', [PostAdminController::class, 'index'])->name('admin.index');
    Route::get('create', [PostAdminController::class, 'create'])->name('admin.create');
    Route::post('store', [PostAdminController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [PostAdminController::class, 'edit'])->name('admin.edit');
    Route::put('update/{id}', [PostAdminController::class, 'update'])->name('admin.update');
    Route::get('destroy/{id}', [PostAdminController::class, 'destroy'])->name('admin.destroy');

});