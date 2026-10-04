<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AuthService implements AuthServiceInterface
{
    public function register(array $data)
    {
        DB::beginTransaction();
        try {
            // إنشاء المستخدم الأساسي
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => $data['password'],
                'role' => $data['role'] ?? 'user',
            ]);

            if (in_array($user->role, ['broker', 'agency'])) {
                $user->businessProfile()->create([
                    'commercial_name' => $data['commercial_name'] ?? null,
                    'specialty' => $data['specialty'] ?? null,
                ]);
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            DB::commit();
            return [
                'user' => $user->load('businessProfile'),
                'token' => $token
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['البيانات المدخلة غير صحيحة.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user->load('businessProfile'),
            'token' => $token
        ];
    }

    public function logout($user)
    {
        $user->tokens()->delete();
        return true;
    }
}
