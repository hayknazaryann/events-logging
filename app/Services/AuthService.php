<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiControllerTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{
    use ApiControllerTrait;

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function login(array $data): JsonResponse
    {
        try {
            if(!Auth::attempt($data)) {
                return $this->errorResponse('Unauthorized: Invalid credentials', 401);
            }

            $token = request()->user()->createToken('authToken')->plainTextToken;

            return $this->successResponse(
                data: [
                    'token' => $token
                ],
                message: __('Successfully logged in.')
            );
        } catch (\Exception $exception) {
            Log::error('Login error: ' . $exception->getMessage());
            return $this->errorResponse(
                message: __('Something went wrong !')
            );
        }
    }

    /**
     * @param array $data
     * @return JsonResponse
     */
    public function register(array $data): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data['password'] = Hash::make($data['password']);
            User::query()->create($data);
            DB::commit();
            return $this->successResponse(
                message: __('Successfully registered. Now you can login.'),
                statusCode: 201
            );
        } catch (\Exception $exception) {
            DB::rollback();
            Log::error('Register error: ' . $exception->getMessage());
            return $this->errorResponse(
                message: __('Something went wrong !')
            );
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        try {
            request()->user()->tokens()->delete();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return $this->successResponse(
                data: [],
                message: __('Successfully logged out')
            );
        } catch (\Exception $exception) {
            return $this->errorResponse(
                message: __('Something went wrong !')
            );
        }
    }

}
