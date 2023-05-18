<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\PublishController;
use App\Http\Controllers\TokenController;
use Illuminate\Http\Request;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Publishes
Route::post('/publishes/preview', [PublishController::class, 'preview'])->name('publishes.preview');
Route::resource('publishes', PublishController::class);
 Route::get('/publishes/create', [PublishController::class, 'create'])->name('publishes.create');
 Route::get('/publishes/{publish}/edit', [PublishController::class, 'edit'])->name('publishes.edit');
 Route::delete('/publishes/{publish}', [PublishController::class, 'destroy'])->name('publishes.destroy');
 Route::put('/publishes/{publish}', [PublishController::class, 'update'])->name('publishes.update');
 Route::get('/publishes/{publish}', [PublishController::class, 'show'])->name('publishes.show');
 Route::post('/publishes', [PublishController::class, 'store'])->name('publishes.store');
 Route::get('/publishes', [PublishController::class, 'index'])->name('publishes.index');

// Resumes
 Route::get('/resumes/create', [ResumeController::class, 'create'])->name('resumes.create');
 Route::get('/resumes/{resume}/edit/', [ResumeController::class, 'edit'])->name('resumes.edit');
 Route::put('/resumes/{resume}', [ResumeController::class, 'update'])->name('resumes.update');
 Route::delete('/resumes/{resume}', [ResumeController::class, 'destroy'])->name('resumes.destroy');
 Route::post('/resumes', [ResumeController::class, 'store'])->name('resumes.store');
 Route::get('/resumes', [ResumeController::class, 'index'])->name('resumes.index');
Route::resource('resumes', ResumeController::class);

Route::prefix('/tokens')->middleware('auth')->name('tokens.')->group(function() {
    Route::get('/create', fn() => view('tokens/create'))->name('create');

    Route::post('/', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    })->name('store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
