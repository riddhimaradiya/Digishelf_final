<?php
include_once 'header_all.php';
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

// Members class
class Members {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Fetch all members from the database
    public function getAllMembers() {
        $query = "SELECT member_id, member_name, member_email, member_type FROM member_details";
        return $this->conn->query($query);
    }
}

// Initialize Members class and fetch all members
$membersClass = new Members($conn);
$members = $membersClass->getAllMembers();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: #f8f9fa;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
      }
      .members-section {
        max-width: 900px;
        margin: 48px auto 48px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(160,82,45,0.09);
        padding: 40px 32px 32px 32px;
        border: 1px solid #eee;
      }
      .members-section h1 {
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
      .btn-warning {
        border-radius: 18px;
        font-weight: 600;
        padding: 6px 18px;
        font-size: 1rem;
        background: #f39c12;
        border: none;
        color: #fff;
      }
      .btn-warning:hover {
        opacity: 0.9;
      }
      .btn-secondary {
        border-radius: 18px;
        font-weight: 600;
        padding: 6px 18px;
        font-size: 1rem;
      }
      @media (max-width: 900px) {
        .members-section {
          padding: 18px 8px;
        }
        .table th, .table td {
          font-size: 0.98rem;
        }
      }
    </style>
</head>
<body>
    <div class="members-section">
        <h1>Library Members</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Member Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($members && $members->num_rows > 0): ?>
                    <?php while ($row = $members->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['member_id'] ?></td>
                            <td><?= $row['member_name'] ?></td>
                            <td><?= $row['member_email'] ?></td>
                            <td><?= $row['member_type'] ?></td>
                            <td>
                                <a href="fine_member.php?member_id=<?= $row['member_id'] ?>" 
                                   class="btn btn-warning btn-sm">Fine</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No members found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
