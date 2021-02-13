<?php

use App\Http\Resources\ResumeResource;
use App\Models\Resume;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/resumes/{resume}', function (Resume $resume){
    if (auth()->user()->id != $resume->id) {
        return response()->setStatusCode(403)->json(['message' => 'Unauthorized']);
    }

    return new ResumeResource($resume);
})->middleware('auth:sanctum');

Route::get('/resumes', fn() => new ResumeResource(auth()->user()->resumes->all()))
    ->middleware('auth:sanctum');
