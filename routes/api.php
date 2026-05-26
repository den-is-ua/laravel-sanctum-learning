<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::post('/user/token', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    $user = User::where('email', $validated['email'])->firstOrFail();

    if (! Hash::check($validated['password'], $user->password)) {
        abort(401, 'Not authorized');
    }

    $token = $user->createToken('api');

    return response()->json(['token' => $token->plainTextToken]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
