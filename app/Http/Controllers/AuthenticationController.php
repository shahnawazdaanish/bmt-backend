<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetConfirmRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SignUpRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function signUp(SignUpRequest $signUpRequest): \Illuminate\Http\Response
    {
        try {
            $user = new User();
            $user->name = $signUpRequest->get('name');
            $user->email = $signUpRequest->get('email');
            $user->password = Hash::make($signUpRequest->get('password'));
            $user->save();
        }
        catch (\Exception $exception) {
            return Response::make($exception->getMessage(), 400);
        }

        return Response::make();
    }

    public function login(LoginRequest $loginRequest)
    {
        $user = User::where('email', $loginRequest->email)->first();

        if (! $user || ! Hash::check($loginRequest->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($loginRequest->email)->plainTextToken;
    }

    public function reset(ResetPasswordRequest $resetPasswordRequest): \Illuminate\Http\Response
    {
        return Response::make();
    }

    public function resetConfirm(ResetConfirmRequest $resetConfirmRequest): \Illuminate\Http\Response
    {
        $user = User::where('email', $resetConfirmRequest->email)->first();
        if (! $user || ! Hash::check($resetConfirmRequest->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->password = $resetConfirmRequest->new_password;
        $user->save();

        return Response::make();
    }

    public function logout(): \Illuminate\Http\Response
    {
        auth()->user()->tokens()->delete();
        return Response::make();
    }
}
