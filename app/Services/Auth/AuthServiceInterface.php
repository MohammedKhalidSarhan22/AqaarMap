<?php
namespace App\Services\Auth;

interface AuthServiceInterface
{
    public function register(array $data);
    public function login(array $credentials);
    public function logout($user);
}
