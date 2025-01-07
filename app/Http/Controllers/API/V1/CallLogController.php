<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCallLogRequest;
use App\Http\Requests\UpdateCallLogRequest;
use App\Http\Resources\CallLogResource;
use App\Models\CallLog;

class CallLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CallLogResource::collection(CallLog::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCallLogRequest $request)
    {
       $callLog =  CallLog::create($request->validated());

        return CallLogResource::make($callLog);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $callLog = CallLog::find($id);

        if (!$callLog) {
            return response()->json(['message' => 'Call log not found'], 404);
        }

        return new CallLogResource($callLog);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCallLogRequest $request, CallLog $callLog)
    {
        $callLog->update($request->validated());
        return CallLogResource::make($callLog);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CallLog $callLog)
    {
        //
    }
}
