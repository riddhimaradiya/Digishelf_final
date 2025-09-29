<?php
// Move session and access control to the very top before any output
session_start();
// Access control: Only admin or librarian
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'librarian'])) {
    header('Location: librarian_login.php');
    exit();
}
include 'header_all.php';
include 'config.php';
include 'book_class.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $isbn = trim($_POST['isbn'] ?? '');
    $publisher = trim($_POST['publisher'] ?? '');
    $year = trim($_POST['year'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $quantity = intval($_POST['quantity'] ?? 0);
    $cover = '';

    // Validate required fields
    if ($title && $author && $isbn && $publisher && $year && $category && $quantity > 0) {
        // Handle file upload
        if (!empty($_FILES['cover']['name'])) {
            $target_dir = 'uploads/';
            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
            $target_file = $target_dir . basename($_FILES['cover']['name']);
            if (move_uploaded_file($_FILES['cover']['tmp_name'], $target_file)) {
                $cover = $target_file;
            } else {
                $message = '<div class="alert alert-danger">Failed to upload cover image.</div>';
            }
        }
        // Insert book using book_class.php
        $book = new Book();
        $result = $book->addBook($title, $author, $isbn, $publisher, $year, $category, $quantity, $cover);
        if ($result) {
            $message = '<div class="alert alert-success">Book added successfully!</div>';
        } else {
            $message = '<div class="alert alert-danger">Failed to add book. Please try again.</div>';
        }
    } else {
        $message = '<div class="alert alert-danger">Please fill all required fields.</div>';
    }
}
?>

<style>
    body {
        background: #f8f9fa;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .add-books-section {
        max-width: 520px;
        margin: 48px auto 48px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(160,82,45,0.09);
        padding: 40px 32px 32px 32px;
        border: 1px solid #eee;
    }
    .add-books-section h2 {
        color: #a0522d;
        font-weight: 700;
        text-align: center;
        margin-bottom: 24px;
        font-size: 2.1rem;
        letter-spacing: 1px;
    }
    .add-books-section label {
        color: #3e2723;
        font-weight: 500;
        margin-bottom: 6px;
    }
    .add-books-section .form-control, .add-books-section .form-control-file {
        border-radius: 16px;
        border: 1px solid #a0522d;
        margin-bottom: 18px;
        font-size: 1.05rem;
        padding: 10px 16px;
        background: #fdf6f0;
    }
    .add-books-section .form-control-file {
        background: #fff;
        border: none;
        padding: 0;
    }
    .add-books-section .btn-primary {
        background: #a0522d;
        border: none;
        border-radius: 24px;
        font-weight: 600;
        padding: 10px 32px;
        font-size: 1.1rem;
        transition: background 0.2s;
        display: block;
        margin: 0 auto;
    }
    .add-books-section .btn-primary:hover {
        background: #d2691e;
    }
    .alert {
        border-radius: 12px;
        font-size: 1rem;
        margin-bottom: 18px;
        text-align: center;
    }
</style>
<div class="add-books-section">
        <h2>Add New Book</h2>
        <?php echo $message; ?>
        <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                        <label>Book Title*</label>
                        <input type="text" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                        <label>Author*</label>
                        <input type="text" name="author" class="form-control" required>
                </div>
                <div class="form-group">
                        <label>ISBN*</label>
                        <input type="text" name="isbn" class="form-control" required>
                </div>
                <div class="form-group">
                        <label>Publisher*</label>
                        <input type="text" name="publisher" class="form-control" required>
                </div>
                <div class="form-group">
                        <label>Year*</label>
                        <input type="number" name="year" class="form-control" required>
                </div>
                <div class="form-group">
                        <label>Category*</label>
                        <input type="text" name="category" class="form-control" required>
                </div>
                <div class="form-group">
                        <label>Quantity*</label>
                        <input type="number" name="quantity" class="form-control" min="1" required>
                </div>
                <div class="form-group">
                        <label>Cover Image</label>
                        <input type="file" name="cover" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
</div>
<?php include 'footer.php'; ?>
