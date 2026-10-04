<?php
namespace App\Http\Controllers;

use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,broker,agency',
            'commercial_name' => 'required_if:role,broker,agency|string|max:255',
            'specialty' => 'nullable|string|max:255',
        ]);

        try {
            $result = $this->authService->register($validatedData);
            return response()->json([
                'message' => 'تم إنشاء الحساب بنجاح',
                'data' => $result
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'حدث خطأ أثناء التسجيل: ' . $e->getMessage()], 500);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $result = $this->authService->login($credentials);
            return response()->json([
                'message' => 'تم تسجيل الدخول بنجاح',
                'data' => $result
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 401);
        }
    }

    public function logout(Request $request)
    {
        $this->authService->logout($request->user());
        return response()->json(['message' => 'تم تسجيل الخروج بنجاح']);
    }
}
