<?php

use App\Http\Controllers\AgeController;
use App\Http\Controllers\PeopleController;
use App\Models\People;
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

Route::middleware('api')->group(function () {
    Route::get('people/find/{name}', [PeopleController::class, 'find']);
    Route::resource('people', PeopleController::class);

    Route::get('age/{age}', [AgeController::class, 'age']);
    Route::get('age-gage/{age}', [AgeController::class, 'gageAge']);
});