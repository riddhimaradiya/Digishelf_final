<?php
include 'config.php';

session_start();

if (!isset($_SESSION['member_id'])) {
    header("Location: member_login.php");
    exit();
}

$member_id = $_SESSION['member_id'];

class MemberDashboard {
    public $conn;
    public $memberId;
    public $memberData;

    public function __construct($dbConnection, $member_id) {
        $this->conn = $dbConnection;
        $this->memberId = $member_id;
    }

    public function fetchMemberDetails() {
        $sql = "SELECT * FROM member_details WHERE member_id = $this->memberId";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $this->memberData = $result->fetch_assoc();
        } else {
            die("Member not found.");
        }
    }

    public function getMemberName() {
        return $this->memberData['member_name']; 
    }
}

$dashboard = new MemberDashboard($conn, $member_id);
$dashboard->fetchMemberDetails();
?>
<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Member Dashboard - Digishelf</title>
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                    <style>
                        body {
                            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
                            background: linear-gradient(135deg, #f5f5dc 0%, #e6d3b3 100%);
                            min-height:100vh;
                        }
                        .welcome-card {
                            background: #fff7e6;
                            border-radius: 1.2rem;
                            box-shadow: 0 4px 18px rgba(160,82,45,0.13);
                            margin-bottom: 2rem;
                        }
                        .dashboard-section {
                            margin-top: 2rem;
                        }
                        .dashboard-card {
                            border-radius: 1rem;
                            box-shadow: 0 2px 12px rgba(123,47,54,0.08);
                            margin-bottom: 1.5rem;
                            transition: transform 0.2s;
                        }
                        .dashboard-card:hover {
                            transform: translateY(-4px) scale(1.02);
                        }
                        .dashboard-card .btn {
                            font-size: 1rem;
                            font-weight: 500;
                            border-radius: 0.5rem;
                            margin-top: 0.5rem;
                        }
                        .dashboard-card .card-title {
                            font-weight: 600;
                            font-size: 1.2rem;
                        }
                        .dashboard-card .card-text {
                            font-size: 1rem;
                            margin-bottom: 1rem;
                        }
                        .dashboard-logout {
                            margin-top: 2rem;
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
                <body>
                    <?php include 'header_all.php'; ?>
                    <div class="container py-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card welcome-card shadow-lg mb-4">
                                    <div class="card-body text-center">
                                        <h2 class="card-title mb-2" style="color:#7B2F36;">Welcome, <?= $dashboard->getMemberName() ?></h2>
                                        <p class="lead">Your Reading Journey Begins Here!</p>
                                    </div>
                                </div>
                                <div class="dashboard-section">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="card dashboard-card border-success">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="color:#2e7d32;"><i class="fa fa-user-circle"></i> View Profile</h4>
                                                    <p class="card-text">Check and review your personal details and membership information.</p>
                                                    <a href="view_member_profile.php" class="btn btn-success w-100">View Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card dashboard-card border-warning">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="color:#f9a825;"><i class="fa fa-book"></i> View Booklist</h4>
                                                    <p class="card-text">Explore the library's collection and discover your next read.</p>
                                                    <a href="view_book.php" class="btn btn-warning w-100">View Booklist</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card dashboard-card border-info">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="color:#00838f;"><i class="fa fa-paper-plane"></i> Request Book</h4>
                                                    <p class="card-text">Reserve the books you want to borrow from the library.</p>
                                                    <a href="request_book.php" class="btn btn-info w-100">Request Book</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card dashboard-card border-dark">
                                                <div class="card-body">
                                                    <h4 class="card-title" style="color:#263238;"><i class="fa fa-undo"></i> Return Book</h4>
                                                    <p class="card-text">Manage and confirm the return of borrowed books on time.</p>
                                                    <a href="return_book.php" class="btn btn-dark w-100">Return Book</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-logout">
                                    <a href="member_logout.php" class="btn btn-danger">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer>
                        <p>&copy; <?= date('Y') ?> Library Management System. All Rights Reserved.</p>
                    </footer>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                </body>
                </html>
