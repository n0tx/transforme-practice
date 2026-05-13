<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
</head>

<body>
    <h1>Daftar Buku</h1>
    <a href="/books/create" style="text-decoration: none;">+ Tambah Buku</a><br><br>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
        <?php /** @var array $books */ ?>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= $book['id'] ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['category']) ?></td>
                <td>
                    <a href="/books/edit?id=<?= $book['id'] ?>" style="text-decoration: none;">Ubah</a> |
                    <a href="/books/delete?id=<?= $book['id'] ?>" style="text-decoration: none;" onclick="return confirm('Yakin hapus buku ini?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>