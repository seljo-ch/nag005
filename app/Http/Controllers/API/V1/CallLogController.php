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
    public function update(UpdateCallLogRequest $request, $id)
    {
        // Versuche, das CallLog-Modell anhand der ID zu finden
        $callLog = CallLog::find($id);

        if (!$callLog) {
            // Wenn das Modell nicht gefunden wird, gib eine Fehlermeldung zurück
            return response()->json(['message' => 'Call log not found'], 404);
        }

        // Validierte Daten holen
        $validatedData = $request->validated();

        // Falls der Timestamp vorhanden ist, sicherstellen, dass er korrekt formatiert wird
        if (isset($validatedData['Timestamp'])) {
            $validatedData['Timestamp'] = \Carbon\Carbon::parse($validatedData['Timestamp'])->format('Y-m-d H:i:s');
        }

        // Das Update auf das Modell anwenden
        if ($callLog->update($validatedData)) {
            \Log::info("CallLog updated successfully.");
        } else {
            \Log::error("Failed to update CallLog with ID {$callLog->id}. Update data: " . json_encode($validatedData));
        }

        return new CallLogResource($callLog);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CallLog $request, $id)
    {
        $callLog = CallLog::find($id);

        if (!$callLog) {
            return response()->json(['message' => 'Call log not found'], 404);
        }

        $callLog->delete();

        return response()->noContent();
    }
}
