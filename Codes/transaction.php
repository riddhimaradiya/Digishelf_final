<?php
include 'config.php';
session_start();
if (!isset($_SESSION['librarian_id'])) {
    header("Location: librarian_login.php");
    exit();
}

class Transaction {
    public $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function fetchAllTransactions() {
        $sql = "SELECT br.br_id, br.issue_date, br.return_date, br.issue_status, br.return_status,
                       m.member_name, b.book_title
                FROM borrow_return br
                JOIN member_details m ON br.member_id = m.member_id
                LEFT JOIN book_details b ON br.book_id = b.book_id";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function updateReturnDate($transactionId, $returnDate) {
        $sql = "UPDATE borrow_return SET return_date = '$returnDate' WHERE br_id = $transactionId";
        return $this->conn->query($sql);
    }

    public function updateIssueStatus($transactionId, $statusValue) {
        $sql = "UPDATE borrow_return SET issue_status = '$statusValue', issue_date = CURDATE() WHERE br_id = $transactionId";
        return $this->conn->query($sql);
    }
}

$transaction = new Transaction($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transactionId = $_POST['transaction_id'];
    $statusType = $_POST['status_type'];
    $returnDate = $_POST['return_date'] ?? null;

    if ($statusType == 'issue') {
        if ($transaction->updateIssueStatus($transactionId, 'Issued')) {
            $success_message = "Transaction issued successfully!";
        } else {
            $error_message = "Failed to issue transaction.";
        }
    } elseif ($statusType == 'return') {
        if ($transaction->updateReturnDate($transactionId, $returnDate)) {
            $success_message = "Return date updated successfully!";
        } else {
            $error_message = "Failed to update return date.";
        }
    }
}

$transactions = $transaction->fetchAllTransactions();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transactions</title>
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
        .btn-primary {
            background: linear-gradient(90deg, #a0522d 60%, #6c757d 100%);
            border: none;
        }
        .btn-success, .btn-warning, .btn-secondary {
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
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
        <?php include 'header_all.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center page-title">Manage Transactions</h2>
        <?php if (isset($success_message)) { ?>
        <div class="alert alert-success"><?= $success_message ?></div>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
        <div class="alert alert-danger"><?= $error_message ?></div>
        <?php } ?>
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Member</th>
                        <th>Book</th>
                        <th>Issue Date</th>
                        <th>Return Date</th>
                        <th>Issue Status</th>
                        <th>Return Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($transactions && $transactions->num_rows > 0) { ?>
                    <?php while ($row = $transactions->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['br_id'] ?></td>
                        <td><?= $row['member_name'] ?></td>
                        <td><?= $row['book_title'] ?></td>
                        <td><?= $row['issue_date'] ? $row['issue_date'] : 'N/A' ?></td>
                        <td><?= $row['return_date'] ? $row['return_date'] : 'N/A' ?></td>
                        <td><?= $row['issue_status'] ?></td>
                        <td><?= $row['return_status'] ?></td>
                        <td>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="transaction_id" value="<?= $row['br_id'] ?>">
                                <input type="hidden" name="status_type" value="issue">
                                <button type="submit" class="btn btn-success btn-sm"
                                    <?= $row['issue_status'] == 'Issued' ? 'disabled' : '' ?>>
                                    Issue
                                </button>
                            </form>
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#returnModal-<?= $row['br_id'] ?>">Return</button>
                            <div class="modal fade" id="returnModal-<?= $row['br_id'] ?>" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Set Return Date</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="return_date" class="form-label">Return Date</label>
                                                    <input type="date" name="return_date" class="form-control" required>
                                                </div>
                                                <input type="hidden" name="transaction_id" value="<?= $row['br_id'] ?>">
                                                <input type="hidden" name="status_type" value="return">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                    <tr>
                        <td colspan="8" class="text-center">No transactions found</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="librarian_dashboard.php" class="btn btn-secondary back-btn">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>