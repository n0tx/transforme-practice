<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Buku</title>
</head>

<body>
    <h1>Daftar Buku</h1>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Kategori</th>
        </tr>
        <?php /** @var array $books */ ?>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= $book['id'] ?></td>
                <td><?= htmlspecialchars($book['title']) ?></td>
                <td><?= htmlspecialchars($book['category']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>