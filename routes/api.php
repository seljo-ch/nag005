<?php

use App\Http\Controllers\API\V1\CallJournalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('/calljournal', CallJournalController::class);
    //


});
