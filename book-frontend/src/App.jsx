import { useEffect, useState } from 'react';
import './App.css';

const API_URL = 'http://localhost:8080/api/books';

function App() {
  const [books, setBooks] = useState([]);
  const [loading, setLoading] = useState(true);
  const [title, setTitle] = useState('');
  const [category, setCategory] = useState('');

  // Fetch books saat komponen pertama kali dirender
  useEffect(() => {
    fetchBooks();
  }, []);

  // Fungsi untuk menarik data dari API PHP
  const fetchBooks = async () => {
    try {
      const response = await fetch(API_URL);
      const data = await response.json();
      setBooks(data);
    } catch (error) {
      console.error("Error fetching books:", error);
    } finally {
      setLoading(false);
    }
  };

  // Fungsi untuk menambah buku baru
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!title || !category) return;

    try {
      const response = await fetch(API_URL, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ title, category }),
      });

      if (response.ok) {
        setTitle('');
        setCategory('');
        fetchBooks(); // Refresh list otomatis setelah tambah sukses
      }
    } catch (error) {
      console.error("Error adding book:", error);
    }
  };

  // Fungsi untuk menghapus buku
  const handleDelete = async (id) => {
    if (!window.confirm('Yakin ingin menghapus buku ini?')) return;
    
    try {
      const response = await fetch(`${API_URL}?id=${id}`, {
        method: 'DELETE',
      });
      
      if (response.ok) {
        fetchBooks(); // Refresh list otomatis setelah hapus sukses
      }
    } catch (error) {
      console.error("Error deleting book:", error);
    }
  };

  return (
    <div className="container">
      <header>
        <h1>Library Transforme</h1>
        <p className="subtitle">Modern Book Management System</p>
      </header>

      <div className="form-container">
        <form className="book-form" onSubmit={handleSubmit}>
          <input 
            type="text" 
            placeholder="Judul Buku..." 
            value={title}
            onChange={(e) => setTitle(e.target.value)}
          />
          <input 
            type="text" 
            placeholder="Kategori..." 
            value={category}
            onChange={(e) => setCategory(e.target.value)}
          />
          <button type="submit">
            + Tambah
          </button>
        </form>
      </div>

      {loading ? (
        <div className="loader"></div>
      ) : (
        <div className="books-grid">
          {books.map(book => (
            <div key={book.id} className="book-card">
              <h3 className="book-title">{book.title}</h3>
              <span className="book-category">{book.category}</span>
              <div className="card-actions">
                <button className="btn-danger" onClick={() => handleDelete(book.id)}>
                  Hapus
                </button>
              </div>
            </div>
          ))}
          
          {books.length === 0 && (
            <p style={{textAlign: 'center', gridColumn: '1 / -1', color: 'var(--text-muted)'}}>
              Belum ada buku. Silakan tambahkan di atas!
            </p>
          )}
        </div>
      )}
    </div>
  );
}

export default App;
