<?php
namespace Src\Controllers;

class AuthController {
    public static function login($username, $password): bool {
        if ($username === 'admin' && $password === '1234') {
            $_SESSION['user'] = $username;
            return true;
        }
        
        return false;
    }

    public static function logout(): void {
        session_destroy();
    }

    public static function check(): bool {
        return isset($_SESSION['user']);
    }
}