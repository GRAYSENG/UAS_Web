<?php
session_start();

// Autoload manual sederhana
require_once 'config/Database.php';

// Ambil URL
$url = isset($_GET['url']) ? $_GET['url'] : 'auth/login';
$url = rtrim($url, '/');
$url = explode('/', $url);

// Tentukan Controller dan Method
$controllerName = isset($url[0]) ? ucfirst($url[0]) : 'Auth';
$methodName = isset($url[1]) ? $url[1] : 'index';

// Cek apakah file controller ada
if (file_exists('controllers/' . $controllerName . '.php')) {
    require_once 'controllers/' . $controllerName . '.php';
    $controller = new $controllerName();

    // Cek method
    if (method_exists($controller, $methodName)) {
        // Ambil parameter jika ada (misal ID untuk edit/delete)
        $params = array_values(array_slice($url, 2));
        call_user_func_array([$controller, $methodName], $params);
    } else {
        echo "Method tidak ditemukan!";
    }
} else {
    echo "Controller tidak ditemukan!";
}
?>