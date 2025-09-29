<?php  
include 'header_all.php';
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

class AdminLibrarianList {
    public $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getAllLibrarians() {
        $query = "SELECT librarian_id, librarian_name, librarian_email FROM librarian_details";
        return $this->conn->query($query);
    }

    public function deleteLibrarian($librarianId) {
        // Finally, delete the librarian from librarian_details
        $query = "DELETE FROM librarian_details WHERE librarian_id = $librarianId";
        return $this->conn->query($query);
    }
}

$librarianList = new AdminLibrarianList($conn);

// Handle delete request
if (isset($_GET['delete_id'])) {
    $deleteId = intval($_GET['delete_id']); 
    if ($librarianList->deleteLibrarian($deleteId)) {
        echo "<script>alert('Librarian deleted successfully!'); window.location.href = 'admin_view_librarian.php';</script>";
    } else {
        echo "<script>alert('Failed to delete librarian.');</script>";
    }
}

$librarians = $librarianList->getAllLibrarians();
?>

<!DOCTYPE html>
<html lang="en">


<head>
        <meta charset="UTF-8">
        <title>Admin View Librarians</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background: #f8f9fa;
                font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            }
            .librarian-section {
                max-width: 800px;
                margin: 48px auto 48px auto;
                background: #fff;
                border-radius: 18px;
                box-shadow: 0 2px 12px rgba(160,82,45,0.09);
                padding: 40px 32px 32px 32px;
                border: 1px solid #eee;
            }
            .librarian-section h2 {
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
            .btn-danger {
                border-radius: 18px;
                font-weight: 600;
                padding: 6px 18px;
                font-size: 1rem;
                background: #e74c3c;
                border: none;
            }
            .btn-danger:hover {
                opacity: 0.9;
            }
            .btn-secondary {
                border-radius: 18px;
                font-weight: 600;
                padding: 6px 18px;
                font-size: 1rem;
            }
            @media (max-width: 900px) {
                .librarian-section {
                    padding: 18px 8px;
                }
                .table th, .table td {
                    font-size: 0.98rem;
                }
            }
        </style>
</head>
<body>
        <div class="librarian-section">
                <h2>Librarian List</h2>
                <table class="table table-bordered table-striped mt-4">
                        <thead>
                                <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                </tr>
                        </thead>
                        <tbody>
                                <?php if ($librarians && $librarians->num_rows > 0): ?>
                                <?php while ($row = $librarians->fetch_assoc()): ?>
                                <tr>
                                        <td><?= $row['librarian_id']; ?></td>
                                        <td><?= $row['librarian_name']; ?></td>
                                        <td><?= $row['librarian_email']; ?></td>
                                        <td>
                                                <a href="admin_view_librarian.php?delete_id=<?= $row['librarian_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this librarian?');">Delete</a>
                                        </td>
                                </tr>
                                <?php endwhile; ?>
                                <?php else: ?>
                                <tr>
                                        <td colspan="4" class="text-center">No librarians found</td>
                                </tr>
                                <?php endif; ?>
                        </tbody>
                </table>
                <div class="text-center mt-4">
                        <a href="admin_dashboard.php" class="btn btn-secondary btn-sm">Back to Dashboard</a>
                </div>
        </div>
</body>
</html>
