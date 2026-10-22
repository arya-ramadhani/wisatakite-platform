<?php
// config/app.php
// Konfigurasi aplikasi dan session

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menentukan root directory
if (!defined('ROOT_PATH')) {
    define('ROOT_PATH', dirname(__DIR__));
}

// Helper untuk redirect
if (!function_exists('redirect')) {
    function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}
