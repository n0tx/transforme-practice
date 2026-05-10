<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
</head>
<body>
    <h1>Tambah Buku Baru</h1>
    <form action="/books/store" method="POST">
        <label>Judul:</label><br>
        <input type="text" name="title" required><br><br>
        
        <label>Kategori:</label><br>
        <input type="text" name="category" required><br><br>
        
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="/books">Kembali</a>
</body>
</html>
