<?php

class Book
{
    private ?PDO $db = null;

    public function __construct()
    {
        // Menggunakan instance Database yang sudah dibuat
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM books ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // Fungsi Create menggunakan Prepared Statement
    public function create(string $title, string $category): bool
    {
        $query = "INSERT INTO books (title, category) VALUES (:title, :category)";
        $stmt = $this->db->prepare($query);

        // Bind parameter untuk cegah SQL Injection
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category', $category);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
