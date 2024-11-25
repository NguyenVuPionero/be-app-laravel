<?php

namespace App\Http\Controllers;

use App\constant\Constant;
use Illuminate\Http\Request;

class OkrController extends Controller
{
    public function index()
    {
        return response()->json(Constant::OKRS);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:500',
            'status' => 'required|numeric',
        ]);

        $newOkr = [
            'id' => count(Constant::OKRS) + 1,
            'title' => $request->title,
            'description' => $request->description,
        ];

        // Since OKRS is a constant, you cannot modify it directly.
        // You need to handle the storage of new OKRs differently, e.g., using a session or another method.

        return response()->json($newOkr, 201);
    }

    public function show($id)
    {
        $okr = collect(Constant::OKRS)->firstWhere('id', $id);

        if (!$okr) {
            return response()->json(['message' => 'OKR not found'], 404);
        }

        return response()->json($okr);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
        ]);

        $okrIndex = collect(Constant::OKRS)->search(fn($okr) => $okr['id'] == $id);

        if ($okrIndex === false) {
            return response()->json(['message' => 'OKR not found'], 404);
        }

        // Since OKRS is a constant, you cannot modify it directly.
        // You need to handle the update of OKRs differently, e.g., using a session or another method.

        return response()->json(Constant::OKRS[$okrIndex]);
    }

    public function destroy($id)
    {
        $okrIndex = collect(Constant::OKRS)->search(fn($okr) => $okr['id'] == $id);

        if ($okrIndex === false) {
            return response()->json(['message' => 'OKR not found'], 404);
        }

        // Since OKRS is a constant, you cannot modify it directly.
        // You need to handle the deletion of OKRs differently, e.g., using a session or another method.

        return response()->json(null, 204);
    }



}
