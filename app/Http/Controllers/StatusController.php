<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuss = Status::all();

        return StatusResource::collection($statuss);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $status = Status::create([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return new StatusResource($status);
    }

    public function show($id)
    {
        $status = Status::find($id);

        return new StatusResource($status);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
        ]);

        $status = Status::find($id);
        $status->update([
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return new StatusResource($status);
    }

    public function destroy($id)
    {
        $status = Status::find($id);
        $status->delete();

        return response()->json(['message' => 'Deteled Data Status With Code = ' . $status->code]);
    }
}
