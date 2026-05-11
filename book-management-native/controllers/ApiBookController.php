<?php

require_once __DIR__ . '/../models/Book.php';

class ApiBookController
{
    private ?Book $bookModel = null;

    public function __construct()
    {
        $this->bookModel = new Book();

        // Wajib untuk API: Beritahu client/browser bahwa format kembalian kita adalah JSON
        header('Content-Type: application/json');
    }

    // Endpoint: GET /api/books
    public function index()
    {
        // TUGAS 1: 
        // 1. Ambil semua buku dari $this->bookModel
        // 2. Gunakan fungsi json_encode() untuk mengubah array menjadi JSON
        // 3. echo (cetak) JSON tersebut
        $books = $this->bookModel->getAll();
        echo json_encode($books);
    }

    // Endpoint: GET /api/books/id
    public function show(int $id)
    {
        // TUGAS 2:
        // 1. Ambil 1 buku dari $this->bookModel berdasarkan $id
        // 2. Jika buku ditemukan, cetak JSON bukunya
        // 3. Jika tidak ditemukan, set http_response_code(404) lalu cetak JSON error: {"message": "Buku tidak ditemukan"}
        $book = $this->bookModel->getById($id);
        if ($book) {
            echo json_encode($book);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Buku tidak ditemukan"]);
        }
    }
}
