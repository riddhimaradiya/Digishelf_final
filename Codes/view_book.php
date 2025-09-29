<?php
include 'config.php';
include 'header_all.php';
session_start();

if (!isset($_SESSION['member_id'])) {
    header("Location: member_login.php");
    exit();
}

class Book {
    public $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    
    public function getAllBooks() {
        $books = [];
        $sql = "SELECT book_id, book_title, book_genre, book_author, published_year FROM book_details";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }
}

$book = new Book($conn);
$books = $book->getAllBooks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #f8f9fa 60%, #e9ecef 100%);
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #a0522d;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
        }
        .table {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(160,82,45,0.08);
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(90deg, #a0522d 60%, #6c757d 100%);
            color: #fff;
            font-size: 1.1rem;
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.4rem 1.1rem;
        }
        .btn-secondary {
            border: none;
        }
        .back-btn {
            margin-top: 2rem;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 8vh;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>
        <div class="container mt-5">
                <h2 class="text-center page-title">Book List</h2>
        <table class="table table-bordered table-hover mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cover</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Author</th>
                    <th>Published Year</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($books)) { ?>
                <?php foreach ($books as $book) { ?>
                <?php
                    // Map book_id or book_title to a cover image filename
                    // Map book_title to a cover image filename (as in books.php)
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
                    if (isset($coverMap[$book['book_title']])) {
                        $coverFile = $coverMap[$book['book_title']];
                    }
                ?>
                <tr>
                    <td><?= $book['book_id'] ?></td>
                    <td><img src="<?= $coverFile ?>" alt="Cover" style="height:120px;width:85px;object-fit:cover;border-radius:10px;box-shadow:0 2px 8px rgba(160,82,45,0.13);"></td>
                    <td><?= htmlspecialchars($book['book_title']) ?></td>
                    <td><?= htmlspecialchars($book['book_genre']) ?></td>
                    <td><?= htmlspecialchars($book['book_author']) ?></td>
                    <td><?= htmlspecialchars($book['published_year']) ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                    <td colspan="6" class="text-center">No books available</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
                <div class="text-center mt-4">
                        <a href="member_dashboard.php" class="btn btn-secondary back-btn">Back to Dashboard</a>
                </div>
        </div>
        <footer>
                <p>&copy; <?= date('Y') ?> Library Management System. All Rights Reserved.</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>