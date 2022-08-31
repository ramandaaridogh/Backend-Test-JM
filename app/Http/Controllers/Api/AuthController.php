<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\HasApiResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    use HasApiResponse;

    public function login(LoginRequest $request): JsonResponse
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('Laravel Password Grant Client')->plainTextToken;
            return $this->sendResponse([
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token,
            ], 'Login successful');
        }
        return $this->sendError(trans('auth.failed'), [], 401);
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->safe()->except('c_password');
        $data['password'] = bcrypt($data['password']);
        $data['email_verified_at'] = now();
        $user = User::query()->create($data);
        if ($user != null) {
            return $this->sendResponse([
                'name' => $user->name,
                'email' => $user->email,
            ], 'Registration successful');
        } else {
            return $this->sendError('Registration failed', [], 401);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse([], 'Logout successful');
    }
}
