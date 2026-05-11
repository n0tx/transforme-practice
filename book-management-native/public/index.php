<?php
// Entry point aplikasi (Front Controller)

// Load konfigurasi dan core files
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../controllers/BookController.php';

// --- KONFIGURASI CORS (Penting untuk ReactJS) ---
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Tangkap preflight request (OPTIONS) dari browser dan hentikan eksekusi selanjutnya
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
// ------------------------------------------------

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Hapus trailing slash dan root path jika aplikasi jalan di subfolder (misal /book-management-native/public/)
$base_path = '/book-management-native/public'; 
$path = str_replace($base_path, '', $path);

require_once __DIR__ . '/../routes/web.php';
