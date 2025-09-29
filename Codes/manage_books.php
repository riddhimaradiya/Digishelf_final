<?php
include_once 'config.php';
include_once 'book_class.php';

session_start();

if (!isset($_SESSION['librarian_id'])) {
    header("Location: librarian_login.php");
    exit();
}

$book = new Book($conn);
$success_message = "";
$error_message = "";

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_book_id'])) {
    $book_id = $_POST['update_book_id'];
    $title = $_POST['book_title'];
    $genre = $_POST['book_genre'];
    $author = $_POST['book_author'];
    $year = $_POST['published_year'];

    if ($book->updateBook($book_id, $title, $genre, $author, $year)) {
        $success_message = "Book updated successfully!";
    } else {
        $error_message = "Failed to update the book.";
    }
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    if ($book->deleteBook($delete_id)) {
        $success_message = "Book deleted successfully!";
    } else {
        $error_message = "Failed to delete the book.";
    }
}

// Fetch all books
$bookList = $book->getAllBooks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(120deg, #f8f9fa 60%, #e9ecef 100%);
            color: #a0522d;
            margin-bottom: 1.5rem;
            letter-spacing: 1px;
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
        .btn-primary {
            background: linear-gradient(90deg, #a0522d 60%, #6c757d 100%);
            border: none;
        }
        .btn-danger, .btn-success, .btn-secondary {
            border: none;
        }
        .modal-content {
            border-radius: 18px;
        }
        .modal-header {
            background: linear-gradient(90deg, #a0522d 60%, #d2691e 100%);
            color: #fff;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
        .modal-title {
            font-weight: 600;
        }
        .form-label {
            font-weight: 500;
            color: #343a40;
        }
        .form-control {
            border-radius: 8px;
        }
        .alert {
            border-radius: 8px;
            font-size: 1rem;
        }
        .back-btn {
            margin-top: 2rem;
        }
        footer {
            background-color: #343a40;
    <style>
        .navbar-digishelf {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 0.5rem 0 0.5rem 0;
        }
        .navbar-digishelf .navbar-brand {
            font-size: 2rem;
            font-weight: 700;
            color: #a0522d !important;
            letter-spacing: 2px;
            margin-left: 0.5rem;
            display: flex;
            align-items: center;
        }
        .navbar-digishelf .navbar-brand img {
            height: 60px;
            width: 60px;
            object-fit: cover;
            margin-right: 18px;
            border-radius: 14px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            background: #fff;
            padding: 2px;
        }
        .navbar-digishelf .nav-link {
            color: #a0522d !important;
            font-size: 1.25rem;
            font-weight: 500;
            margin-right: 18px;
            letter-spacing: 1px;
        }
        .navbar-digishelf .nav-link:last-child {
            margin-right: 0;
        }
        .navbar-digishelf .navbar-nav {
            margin-left: 1.5rem;
        }
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 8vh;
            border-top-left-radius: 18px;
        <nav class="navbar navbar-expand-lg navbar-digishelf">
            box-shadow: 0 -2px 8px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body class="bg-light">
        <?php include 'header_all.php'; ?>
        <div class="container mt-5">
                <h2 class="text-center page-title">Manage Books</h2>

        <!-- Success and Error Messages -->
        <?php if (!empty($success_message)) { ?>
        <div class="alert alert-success"><?= $success_message ?></div>
        <?php } ?>
        <?php if (!empty($error_message)) { ?>
        <div class="alert alert-danger"><?= $error_message ?></div>
        <?php } ?>

        <!-- Books Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Author</th>
                        <th>Published Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($bookList)) { ?>
                    <?php foreach ($bookList as $book) { ?>
                    <tr>
                        <td><?= $book['book_id'] ?></td>
                        <td><?= $book['book_title'] ?></td>
                        <td><?= $book['book_genre'] ?></td>
                        <td><?= $book['book_author'] ?></td>
                        <td><?= $book['published_year'] ?></td>
                        <td>
                            <a href="?delete_id=<?= $book['book_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#updateModal<?= $book['book_id'] ?>">Update</button>
                        </td>
                    </tr>

                    <!-- Update Modal -->
                    <div class="modal fade" id="updateModal<?= $book['book_id'] ?>" tabindex="-1"
                        aria-labelledby="updateModalLabel<?= $book['book_id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel<?= $book['book_id'] ?>">Update Book</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="">
                                    <div class="modal-body">
                                        <input type="hidden" name="update_book_id" value="<?= $book['book_id'] ?>">
                                        <div class="mb-3">
                                            <label for="book_title" class="form-label">Title</label>
                                            <input type="text" class="form-control" name="book_title"
                                                value="<?= $book['book_title'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="book_genre" class="form-label">Genre</label>
                                            <input type="text" class="form-control" name="book_genre"
                                                value="<?= $book['book_genre'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="book_author" class="form-label">Author</label>
                                            <input type="text" class="form-control" name="book_author"
                                                value="<?= $book['book_author'] ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="published_year" class="form-label">Published Year</label>
                                            <input type="number" class="form-control" name="published_year"
                                                value="<?= $book['published_year'] ?>" min="1500"
                                                max="<?= date('Y') ?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="6" class="text-center">No books found.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <a href="librarian_dashboard.php" class="btn btn-secondary back-btn">Back to Dashboard</a>
        </div>
    </div>
    <footer>
        <p>&copy; <?= date('Y') ?> Library Management System. All Rights Reserved.</p>
    </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
