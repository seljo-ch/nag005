<?php

use App\Http\Controllers\API\V1\CallLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('/calllog', CallLogController::class);
    //


});
Route::any('/debug-log', function (\Illuminate\Http\Request $request) {
    \Log::info('API Call:', [
        'method' => $request->method(),
        'headers' => $request->headers->all(),
        'body' => $request->all()
    ]);

    return response()->json(['message' => 'Logged']);
});
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
