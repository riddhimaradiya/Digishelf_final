<?php
include 'config.php';
session_start();

if (!isset($_SESSION['member_id'])) {
    header("Location: member_login.php");
    exit();
}

class BookRequest {
    public $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function addBookRequest($memberId, $bookTitle, $authorName, $publishedYear) {
        $sql = "INSERT INTO borrow_return (member_id, book_id, issue_status, return_status)
                SELECT $memberId, book_id, 'Not Issued', 'Not Returned'
                FROM book_details
                WHERE book_title = '$bookTitle' AND book_author = '$authorName' AND published_year = '$publishedYear'";

        if ($this->conn->query($sql)) {
            return "Request sent successfully!";
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    public function fetchMemberRequests($memberId) {
        $sql = "SELECT br.br_id, b.book_title, br.issue_status, br.return_status, br.issue_date, br.return_date
                FROM borrow_return br
                LEFT JOIN book_details b ON br.book_id = b.book_id
                WHERE br.member_id = $memberId";
        return $this->conn->query($sql);
    }
}

$request = new BookRequest($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_request'])) {
    $memberId = $_SESSION['member_id'];
    $bookTitle = $_POST['book_title'];
    $authorName = $_POST['author_name'];
    $publishedYear = $_POST['published_year'];

    $message = $request->addBookRequest($memberId, $bookTitle, $authorName, $publishedYear);
}

$memberId = $_SESSION['member_id'];
$requests = $request->fetchMemberRequests($memberId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Request</title>
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
        .form-label {
            font-weight: 500;
            color: #343a40;
        }
        .form-control {
            border-radius: 8px;
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
        .btn-success, .btn-secondary {
            border: none;
        }
        .alert {
            border-radius: 8px;
            font-size: 1rem;
        }
        .back-btn {
            margin-top: 2rem;
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

<body class="bg-light">
        <?php include 'header_all.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center page-title">Book Request</h2>
        <?php if (isset($message)) { ?>
        <div class="alert alert-success"><?= $message ?></div>
        <?php } ?>
        <form method="POST" class="mt-4">
            <div class="mb-3">
                <label for="book_title" class="form-label">Book Title</label>
                <input type="text" class="form-control" id="book_title" name="book_title" placeholder="Enter book title" required>
            </div>
            <div class="mb-3">
                <label for="author_name" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="author_name" name="author_name" placeholder="Enter author name" required>
            </div>
            <div class="mb-3">
                <label for="published_year" class="form-label">Published Year</label>
                <input type="number" class="form-control" id="published_year" name="published_year" placeholder="Enter published year" required>
            </div>
            <div class="d-flex justify-content-start gap-2">
                <button type="submit" name="send_request" class="btn btn-primary">Send Request</button>
                <a href="check_issue.php" class="btn btn-success">Check Issued Books</a>
                <a href="member_dashboard.php" class="btn btn-secondary back-btn">Back to Dashboard</a>
            </div>
        </form>
        <!-- Member Requests Table -->
        <div class="table-responsive mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Request ID</th>
                        <th>Book Title</th>
                        <th>Issue Status</th>
                        <th>Return Status</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($requests && $requests->num_rows > 0) { ?>
                        <?php while ($row = $requests->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['br_id'] ?></td>
                                <td><?= htmlspecialchars($row['book_title']) ?></td>
                                <td><?= htmlspecialchars($row['issue_status']) ?></td>
                                <td><?= htmlspecialchars($row['return_status']) ?></td>
                                <td><?= htmlspecialchars($row['issue_date']) ?></td>
                                <td><?= htmlspecialchars($row['return_date']) ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">No requests found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <footer>
        <p>&copy; <?= date('Y') ?> Library Management System. All Rights Reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>