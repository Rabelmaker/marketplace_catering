<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaceRecognitionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, "login"])->name("login");
Route::post('/login', [AdminController::class, "post_login"])->name("post_login");
$x = "register";
Route::get('/register', [AdminController::class, $x])->name($x);
Route::post('/register', [AdminController::class, "post_$x"])->name("post_$x");
$y = "gantipassword";
Route::get('/gantipassword/{id}', [AdminController::class, $y])->name($y);
Route::post('/gantipassword', [AdminController::class, "post_$y"])->name("post_$y");

Route::group(['middleware' => ['AdminMiddleware']], function () {
    Route::get('/logout', [AdminController::class, "logout"])->name("logout");
    Route::get('/dashboard', [AdminController::class, "dashboard"])->name("dashboard");

    Route::prefix('absenharian')->group(function () {
        $x = "absenharian";
        Route::get('/add/{id}', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/{id}', [AdminController::class, "$x"])->name("$x");
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
    });
    Route::prefix('absenrekap')->group(function () {
        $x = "absenrekap";
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/{id}', [AdminController::class, "$x"])->name("$x");
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
    });

    Route::prefix('user')->group(function () {
        $x = "user";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
        Route::get('/sync', [AdminController::class, "sinkron_$x"])->name("sync_$x");
        Route::get('/reset', [AdminController::class, "reset_$x"])->name("reset_$x");
    });

    Route::prefix('role')->group(function () {
        $x = "role";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('setabsen')->group(function () {
        $x = "setabsen";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('device')->group(function () {
        $x = "device";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });

    Route::prefix('kelas')->group(function () {
        $x = "kelas";
        Route::get('/', [AdminController::class, $x])->name($x);
        Route::post('/', [AdminController::class, "post_$x"])->name("post_$x");
        Route::get('/add', [AdminController::class, "add_$x"])->name("add_$x");
        Route::get('/edit/{id}', [AdminController::class, "edit_$x"])->name("edit_$x");
        Route::get('/delete/{id}', [AdminController::class, "delete_$x"])->name("delete_$x");
    });


    Route::prefix('sekolah')->group(function () {
        Route::post('/', [AdminController::class, "post_sekolah"])->name("post_sekolah");
        Route::get('/edit/{id}', [AdminController::class, "edit_sekolah"])->name("edit_sekolah");
    });





});
