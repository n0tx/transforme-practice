<?php
// Entry point aplikasi (Front Controller)

// Load konfigurasi dan core files
require_once __DIR__ . '/../config/Database.php';

// Simple routing mechanism
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Hapus trailing slash dan root path jika aplikasi jalan di subfolder (misal /book-management-native/public/)
$base_path = '/book-management-native/public'; 
$path = str_replace($base_path, '', $uri);

require_once __DIR__ . '/../routes/web.php';
