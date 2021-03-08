<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Flugg\Responder\Http\Responses\ResponseBuilder;
use Flugg\Responder\Responder;
use Hash;
use Illuminate\Validation\ValidationException;

class AuthenticateController
{
    public function login(LoginRequest $request, Responder $responder): ResponseBuilder
    {
        $user = User::query()->where('email', '=', $request->input('email'))->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $responder->success([
            'token' => $user->createToken($request->input('device_name'))->plainTextToken
        ]);
    }

    public function register(RegisterRequest $request, Responder $responder): ResponseBuilder
    {
        /** @var User $user */
        $user = User::query()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        return $responder->success([
            'token' => $user->createToken($request->input('device_name'))->plainTextToken
        ]);
    }
}