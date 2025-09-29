<?php
include 'config.php';
include 'header_all.php';
session_start();

if (!isset($_SESSION['member_id'])) {
    header("Location: member_login.php");
    exit();
}

class MyIssuedBooks {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function fetchIssuedBooks($memberId) {
 
        $sql = "SELECT br.br_id, b.book_title, br.issue_status, br.return_status, br.issue_date, br.return_date
                FROM borrow_return br
                JOIN book_details b ON br.book_id = b.book_id
                WHERE br.member_id = $memberId AND br.issue_status = 'Issued'";
        return $this->conn->query($sql);
    }
}

$memberId = $_SESSION['member_id']; 
$issuedBooks = new MyIssuedBooks($conn);
$books = $issuedBooks->fetchIssuedBooks($memberId);
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issued Books</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
      body {
        background: #f8f9fa;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
      }
      .issued-books-section {
        max-width: 900px;
        margin: 48px auto 48px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(160,82,45,0.09);
        padding: 40px 32px 32px 32px;
        border: 1px solid #eee;
      }
      .issued-books-section h2 {
        color: #a0522d;
        font-weight: 700;
        text-align: center;
        margin-bottom: 24px;
        font-size: 2.1rem;
        letter-spacing: 1px;
      }
      .table {
        border-radius: 12px;
        overflow: hidden;
        background: #fdf6f0;
      }
      .table th {
        background: #a0522d;
        color: #fff;
        font-weight: 600;
        font-size: 1.08rem;
        text-align: center;
      }
      .table td {
        text-align: center;
        font-size: 1.05rem;
        color: #3e2723;
      }
      .btn-secondary {
        border-radius: 18px;
        font-weight: 600;
        padding: 8px 24px;
        font-size: 1rem;
      }
      @media (max-width: 900px) {
        .issued-books-section {
          padding: 18px 8px;
        }
        .table th, .table td {
          font-size: 0.98rem;
        }
      }
    </style>
</head>
<body>
    <div class="issued-books-section">
        <h2>My Issued Books</h2>
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Book Title</th>
                        <th>Issue Status</th>
                        <th>Return Status</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($books && $books->num_rows > 0) { ?>
                        <?php while ($row = $books->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $row['br_id'] ?></td>
                                <td><?= $row['book_title'] ?></td>
                                <td><?= $row['issue_status'] ?></td>
                                <td><?= $row['return_status'] ?></td>
                                <td><?= $row['issue_date'] ? $row['issue_date'] : 'N/A' ?></td>
                                <td><?= $row['return_date'] ? $row['return_date'] : 'N/A' ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6" class="text-center">No issued books found</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="request_book.php" class="btn btn-secondary">Back to Book Requests</a>
        </div>
    </div>
</body>
</html>
