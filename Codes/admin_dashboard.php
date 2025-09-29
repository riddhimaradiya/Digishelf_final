<?php
include 'config.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

class AdminDashboard {
    public $conn;
    public $adminId;
    public $adminName;

    public function __construct($dbConnection, $admin_id) {
        $this->conn = $dbConnection;
        $this->adminId = $admin_id;
    }

    public function fetchAdminName() {
        $sql = "SELECT admin_name FROM admin_details WHERE admin_id = $this->adminId";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $this->adminName = $row['admin_name'];
        } else {
            $this->adminName = 'Admin'; // Default fallback
        }
    }

    public function getAdminName() {
        return $this->adminName; 
    }

    public function showDashboard() {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .dashboard-section {
            max-width: 1200px;
            margin: 48px auto 48px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(160,82,45,0.09);
            padding: 40px 32px 32px 32px;
            border: 1px solid #eee;
        }
        .dashboard-title {
            color: #a0522d;
            font-weight: 700;
            text-align: center;
            margin-bottom: 24px;
            font-size: 2.1rem;
            letter-spacing: 1px;
        }
        .dashboard-subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 1.15rem;
            margin-bottom: 32px;
        }
        .dashboard-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 32px;
            justify-content: center;
        }
        .dashboard-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(160,82,45,0.13);
            border: 1px solid #eee;
            padding: 32px 24px;
            min-width: 260px;
            max-width: 320px;
            flex: 1 1 260px;
            text-align: center;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .dashboard-card:hover {
            box-shadow: 0 8px 32px rgba(160,82,45,0.18);
            transform: translateY(-4px) scale(1.03);
        }
        .dashboard-card h5 {
            color: #a0522d;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        .dashboard-card p {
            color: #3e2723;
            font-size: 1.05rem;
            margin-bottom: 18px;
        }
        .dashboard-card .btn {
            border-radius: 24px;
            font-weight: 600;
            padding: 10px 32px;
            font-size: 1.08rem;
        }
        .dashboard-logout {
            margin-top: 32px;
            text-align: center;
        }
        @media (max-width: 900px) {
            .dashboard-section {
                padding: 18px 8px;
            }
            .dashboard-cards {
                gap: 18px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header_all.php'; ?>
    <div class="dashboard-section">
        <div class="dashboard-title">Welcome, <?= $this->getAdminName() ?></div>
        <div class="dashboard-subtitle">Administrator</div>
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h5>Add Librarian</h5>
                <p>Add a new librarian to the system.</p>
                <a href="admin_add_librarian.php" class="btn btn-success">Add Librarian</a>
            </div>
            <div class="dashboard-card">
                <h5>Add Member</h5>
                <p>Add a new member to the system.</p>
                <a href="admin_add_member.php" class="btn btn-success">Add Member</a>
            </div>
            <div class="dashboard-card">
                <h5>View Librarian</h5>
                <p>Check the list of all librarians.</p>
                <a href="admin_view_librarian.php" class="btn btn-primary">View Librarian</a>
            </div>
            <div class="dashboard-card">
                <h5>View Member</h5>
                <p>Manage all registered members.</p>
                <a href="admin_view_member.php" class="btn btn-warning">View Member</a>
            </div>
            <div class="dashboard-card">
                <h5>Generate Report</h5>
                <p>Generate system reports.</p>
                <a href="admin_generate_report.php" class="btn btn-info">Generate Report</a>
            </div>
            <div class="dashboard-card">
                <h5>Add Books</h5>
                <p>Add new books to the library collection.</p>
                <a href="add_books.php" class="btn btn-primary">Add Books</a>
            </div>
        </div>
        <div class="dashboard-logout">
            <a href="admin_logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    }
}

$dashboard = new AdminDashboard($conn, $admin_id);
$dashboard->fetchAdminName();
$dashboard->showDashboard();
?>
