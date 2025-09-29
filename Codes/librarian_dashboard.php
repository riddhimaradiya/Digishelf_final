<?php
include 'config.php';

session_start();

if (!isset($_SESSION['librarian_id'])) {
    header("Location: librarian_login.php");
    exit();
}

$librarian_id = $_SESSION['librarian_id'];

class LibrarianDashboard {
    public $conn;
    public $librarianId;
    public $librarianData;

    public function __construct($dbConnection, $librarian_id) {
        $this->conn = $dbConnection;
        $this->librarianId = $librarian_id;
    }

    public function fetchLibrarianDetails() {
        $sql = "SELECT * FROM librarian_details WHERE librarian_id = $this->librarianId";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $this->librarianData = $result->fetch_assoc();
        } else {
            die("Librarian not found.");
        }
    }

    public function getLibrarianName() {
        return $this->librarianData['librarian_name'];
    }

    public function showDashboard() {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
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
        <div class="dashboard-title">Welcome, <?= $this->getLibrarianName() ?></div>
        <div class="dashboard-subtitle">Your Librarian Dashboard</div>
        <div class="dashboard-cards">
            <div class="dashboard-card">
                <h5>View Profile</h5>
                <p>Access and review your personal details and information.</p>
                <a href="view_librarian_profile.php" class="btn btn-success">View Profile</a>
            </div>
            <div class="dashboard-card">
                <h5>Add Member</h5>
                <p>Add a new member to the system.</p>
                <a href="admin_add_member.php" class="btn btn-success">Add Member</a>
            </div>
            <div class="dashboard-card">
                <h5>Add Books</h5>
                <p>Add new books to the library’s inventory with ease.</p>
                <a href="add_book.php" class="btn btn-primary">Add Books</a>
            </div>
            <div class="dashboard-card">
                <h5>Manage Books</h5>
                <p>Update or remove books from the library’s collection.</p>
                <a href="manage_books.php" class="btn btn-warning">Manage Books</a>
            </div>
            <div class="dashboard-card">
                <h5>Book Transactions</h5>
                <p>Handle issuing and returning of books for members.</p>
                <a href="transaction.php" class="btn btn-info">Manage Transactions</a>
            </div>
            <div class="dashboard-card">
                <h5>Contact Messages</h5>
                <p>View messages submitted via the contact form.</p>
                <a href="view_contact_messages.php" class="btn btn-secondary">View Messages</a>
            </div>
        </div>
        <div class="dashboard-logout">
            <a href="librarian_logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    }
}

$dashboard = new LibrarianDashboard($conn, $librarian_id);
$dashboard->fetchLibrarianDetails();
$dashboard->showDashboard();
?>
