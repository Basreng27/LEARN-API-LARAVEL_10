<?php

namespace App\Http\Controllers;

use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // untuk validasi data inputan
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $account = Account::where('username', $request->username)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            throw ValidationException::withMessages(([
                'username' => ['Your Account Is Not Registered']
            ]));
        }

        return $account->createToken('user logged')->plainTextToken;
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }

    public function logged(Request $request)
    {
        // get data yang sedang login
        return response()->json(Auth::user());
    }

    public function regist(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $account = Account::create([
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return new AccountResource($account);
    }
}
