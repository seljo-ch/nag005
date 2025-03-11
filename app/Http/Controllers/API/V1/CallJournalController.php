<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CallJournalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CallJournal;

class CallJournalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $callJournals = CallJournal::all();
        return response()->json(CallJournalResource::collection($callJournals), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(),[
            'callerNumber' => 'required',
            'adUser' => 'required'
        ]);

        if($validatedData->fails()){
            return response()->json($validatedData->errors(), 422);
        }

        $callJournalEntry = CallJournal::create($request->all());

        return response()->json(new CallJournalResource($callJournalEntry), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $callJournalEntry = CallJournal::find($id);

        if(!$callJournalEntry){
            return response()->json(['message' => 'CallJournal Entry not found'], 404);
        }

        return response()->json(new CallJournalResource($callJournalEntry), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = Validator::make($request->all(),[
            'callerNumber' => 'required',
            'adUser' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 422);
        }

        $callJournalEntry = CallJournal::find($id);

        if (!$callJournalEntry) {
            return response()->json(['message' => 'CallJournal Entry not found'], 404);
        }

        $callJournalEntry->update($request->all());

        return response()->json(new CallJournalResource($callJournalEntry), 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $callJournalEntry = CallJournal::find($id);

        if (!$callJournalEntry) {
            return response()->json(['message' => 'CallJournal Entry not found'], 404);
        }

        $callJournalEntry->delete();

        return response()->json(['message' => 'CallJournal Entry deleted'], 200);

    }
}
