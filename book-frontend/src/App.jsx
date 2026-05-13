import { useEffect, useState } from 'react';
import './App.css';

const API_URL = 'http://localhost:8080/api/books';

function App() {
  const [books, setBooks] = useState([]);
  const [loading, setLoading] = useState(true);
  
  // State untuk form
  const [title, setTitle] = useState('');
  const [category, setCategory] = useState('');
  
  // State penanda apakah sedang dalam mode edit
  const [editId, setEditId] = useState(null);

  useEffect(() => {
    fetchBooks();
  }, []);

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

  // Fungsi dinamis: Jika editId ada, lakukan PUT (Update). Jika tidak, lakukan POST (Tambah).
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!title || !category) return;

    try {
      const url = editId ? `${API_URL}?id=${editId}` : API_URL;
      const method = editId ? 'PUT' : 'POST';

      const response = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ title, category }),
      });

      if (response.ok) {
        setTitle('');
        setCategory('');
        setEditId(null); // Keluar dari mode edit
        fetchBooks(); // Refresh list
      }
    } catch (error) {
      console.error("Error saving book:", error);
    }
  };

  // Memasukkan data buku ke form dan mengaktifkan mode edit
  const handleEditClick = (book) => {
    setTitle(book.title);
    setCategory(book.category);
    setEditId(book.id);
    window.scrollTo({ top: 0, behavior: 'smooth' }); // Scroll otomatis ke atas
  };

  // Fungsi untuk membatalkan mode edit
  const handleCancelEdit = () => {
    setTitle('');
    setCategory('');
    setEditId(null);
  };

  const handleDelete = async (id) => {
    if (!window.confirm('Yakin ingin menghapus buku ini?')) return;
    
    try {
      const response = await fetch(`${API_URL}?id=${id}`, {
        method: 'DELETE',
      });
      
      if (response.ok) {
        // Jika sedang edit buku yang dihapus, batalkan editnya
        if (editId === id) handleCancelEdit();
        fetchBooks(); 
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
          <button type="submit" style={{ backgroundColor: editId ? 'var(--success)' : 'var(--accent)' }}>
            {editId ? '✓ Update' : '+ Tambah'}
          </button>
          
          {/* Tombol batal muncul hanya saat mode edit */}
          {editId && (
            <button type="button" className="btn-danger" onClick={handleCancelEdit}>
              Batal
            </button>
          )}
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
                <button 
                  className="btn-edit" 
                  onClick={() => handleEditClick(book)}
                >
                  Ubah
                </button>
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
