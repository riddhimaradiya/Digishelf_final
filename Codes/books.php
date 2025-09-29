
<?php
session_start();
include 'header_all.php';
include 'config.php';
include 'book_class.php';
// Handle search
$search = trim($_GET['search'] ?? '');
$books = [];
$error = '';
if ($conn->connect_error) {
        $error = 'Database connection failed.';
} else {
        $sql = "SELECT * FROM book_details";
        if ($search) {
                $search_sql = $conn->real_escape_string($search);
                $sql .= " WHERE book_title LIKE '%$search_sql%' OR book_author LIKE '%$search_sql%' OR book_genre LIKE '%$search_sql%' OR published_year LIKE '%$search_sql%'";
        }
        $sql .= " ORDER BY book_id DESC";
        $result = $conn->query($sql);
        if ($result) {
                while ($row = $result->fetch_assoc()) {
                        $books[] = $row;
                }
        }
}
?>
<style>
    body {
        background: #f8f9fa;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .books-section {
        padding-top: 40px;
        padding-bottom: 40px;
        min-height: 80vh;
    }
    .books-title {
        text-align: center;
        color: #a0522d;
        font-weight: 700;
        margin-bottom: 32px;
        letter-spacing: 1px;
        font-size: 2.3rem;
    }
    .search-bar {
        display: flex;
        justify-content: center;
        margin-bottom: 32px;
        gap: 12px;
    }
    .search-bar input[type="search"] {
        border-radius: 18px;
        border: 1px solid #a0522d;
        padding: 10px 18px;
        width: 320px;
        font-size: 1.08rem;
        background: #fdf6f0;
    }
    .search-bar .btn-primary {
        background: #a0522d;
        border: none;
        border-radius: 24px;
        font-weight: 600;
        padding: 10px 32px;
        font-size: 1.08rem;
        transition: background 0.2s;
    }
    .search-bar .btn-primary:hover {
        background: #d2691e;
    }
    .book-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(160,82,45,0.09);
        border: 1px solid #eee;
        margin-bottom: 32px;
        transition: transform 0.15s;
    }
    .book-card:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 4px 18px rgba(160,82,45,0.13);
    }
    .book-card .card-img-top {
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        height: 260px;
        object-fit: cover;
    }
    .book-card .card-body {
        padding: 24px 18px 18px 18px;
    }
    .book-card .card-title {
        color: #a0522d;
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 10px;
        text-align: center;
    }
    .book-card .card-text {
        color: #3e2723;
        font-size: 1.05rem;
    }
    .alert-warning {
        border-radius: 12px;
        font-size: 1rem;
        margin-bottom: 18px;
        text-align: center;
    }
    @media (max-width: 900px) {
        .books-section {
            padding-top: 18px;
            padding-bottom: 18px;
        }
        .search-bar input[type="search"] {
            width: 100%;
        }
    }
</style>
<div class="container books-section">
        <h2 class="books-title">Library Books</h2>
        <form class="search-bar" method="get">
                <input type="search" name="search" placeholder="Search books by title, author, genre, year..." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">Search</button>
        </form>
        <div class="row">
                <?php if (empty($books)): ?>
                        <div class="col-12"><div class="alert alert-warning">No books found.</div></div>
                <?php else: ?>
                        <?php foreach ($books as $book): ?>
                                <div class="col-md-4 col-sm-6 mb-4">
                                        <div class="card book-card h-100">
                                                <?php
                                                // Map book titles to cover images
                                                $coverMap = [
                                                    'Book a' => 'images/book1.jpg',
                                                    '1984' => 'images/book2.jpg',
                                                    'Chokher Bali' => 'images/book3.jpg',
                                                    'To Kill a Mockingbird' => 'images/book4.jpg',
                                                    'The Alchemist' => 'images/book5.jpg',
                                                    'Shesher Kobita' => 'images/book6.jpg',
                                                    'Padma Nodi' => 'images/book7.jpg',
                                                ];
                                                $coverFile = 'images/l.jpg'; // default cover
                                                if (!empty($book['cover_image'])) {
                                                    $coverFile = htmlspecialchars($book['cover_image']);
                                                } elseif (isset($coverMap[$book['book_title']])) {
                                                    $coverFile = $coverMap[$book['book_title']];
                                                }
                                                ?>
                                                <img src="<?php echo $coverFile; ?>" class="card-img-top" alt="Cover">
                                                <div class="card-body">
                                                        <h5 class="card-title"><?php echo htmlspecialchars($book['book_title']); ?></h5>
                                                        <p class="card-text mb-1"><strong>Author:</strong> <?php echo htmlspecialchars($book['book_author']); ?></p>
                                                        <p class="card-text mb-1"><strong>Genre:</strong> <?php echo htmlspecialchars($book['book_genre']); ?></p>
                                                        <p class="card-text mb-1"><strong>Year:</strong> <?php echo htmlspecialchars($book['published_year']); ?></p>
                                                        <p class="card-text mb-1"><strong>ISBN:</strong> <?php echo !empty($book['isbn']);  ?></p>
                                                        <p class="card-text"><strong>Publisher:</strong> <?php echo !empty($book['publisher']); ?></p>
                                                </div>
                                        </div>
                                </div>
                        <?php endforeach; ?>
                <?php endif; ?>
        </div>
</div>
<?php include 'footer.php'; ?>
