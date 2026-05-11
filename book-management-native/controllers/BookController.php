<?php

require_once __DIR__ . '/../models/Book.php';

class BookController
{
    private ?Book $bookModel = null;

    public function __construct()
    {
        $this->bookModel = new Book();
    }

    public function index()
    {
        $books = $this->bookModel->getAll();
        require_once __DIR__ . '/../views/book/index.php';
    }

    // Menampilkan form tambah buku
    public function create()
    {
        require_once __DIR__ . '/../views/book/create.php';
    }

    // Menyimpan data dari form
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $category = $_POST['category'];

            $this->bookModel->create($title, $category);

            // Redirect kembali ke halaman index
            header("Location: /books");
            exit;
        }
    }

    // Menghapus data buku
    public function delete()
    {
        // Pastikan ada parameter id di URL (misal: /books/delete?id=1)
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $this->bookModel->delete($id);
        }
        
        header("Location: /books");
        exit;
    }
}
