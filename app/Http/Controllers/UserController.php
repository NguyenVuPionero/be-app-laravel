<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    //
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required'
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json($user, 201);
        } catch (Exception $e) {
            dd($e);
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required'
        ]);

        $user->update($request->only(['name', 'email', 'password']));

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response()->json(null, 204);
    }
}
