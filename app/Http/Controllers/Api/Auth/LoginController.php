<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|unique|email',
                'password' => 'required',
                'role' => 'required',
            ]
            );

        if (Auth::attempt($credentials)){
            return response()->json('
            Success
            ');
        }
        return response()->json('Your username or password is wrong');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
