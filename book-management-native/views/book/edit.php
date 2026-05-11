<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ubah Buku</title>
</head>

<body>
    <h1>Ubah Data Buku</h1>
    <?php /** @var array $book */ ?>
    <form action="/books/update" method="POST">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">

        <label>Judul:</label><br>
        <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required><br><br>

        <label>Kategori:</label><br>
        <input type="text" name="category" value="<?= htmlspecialchars($book['category']) ?>" required><br><br>

        <button type="submit">Ubah</button>
    </form>
    <br>
    <a href="/books">Kembali</a>
</body>

</html>