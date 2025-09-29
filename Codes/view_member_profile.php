<?php
include 'config.php';
include 'header_all.php';
session_start();

if (!isset($_SESSION['member_id'])) {
    header("Location: member_login.php");
    exit();
}

$member_id = $_SESSION['member_id'];

class MemberProfile {
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
        }
    }

    public function displayProfile() {
        if (!$this->memberData) {
            echo '<div class="container mt-5"><div class="alert alert-danger">Member details not found.</div></div>';
            return;
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Member Profile - Digishelf</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
            <style>
                body {
                    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
                    background: linear-gradient(135deg, #f5f5dc 0%, #e6d3b3 100%);
                    min-height:100vh;
                }
                .profile-card {
                    background: #fff7e6;
                    border-radius: 1.2rem;
                    box-shadow: 0 4px 18px rgba(160,82,45,0.13);
                    margin: 3rem auto 0 auto;
                    max-width: 500px;
                }
                .profile-card .card-title {
                    color: #7B2F36;
                    font-size: 2rem;
                    font-weight: 700;
                }
                .profile-card .lead {
                    color: #6d4c41;
                    font-size: 1.1rem;
                }
                .profile-card .profile-label {
                    color: #a0522d;
                    font-weight: 600;
                }
                .profile-card .profile-value {
                    color: #343a40;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="profile-card card mt-5">
                    <div class="card-body text-center">
                        <h2 class="card-title mb-2">Welcome, <?= htmlspecialchars($this->memberData['member_name']); ?></h2>
                        <p class="lead mb-4">Your Reading Journey Begins Here!</p>
                        <h4 class="mb-3" style="color:#7B2F36;"><i class="fa fa-id-card"></i> Profile Details</h4>
                        <hr>
                        <p><span class="profile-label">Name:</span> <span class="profile-value"><?= htmlspecialchars($this->memberData['member_name']); ?></span></p>
                        <p><span class="profile-label">Member Created:</span> <span class="profile-value"><?= htmlspecialchars($this->memberData['member_created']); ?></span></p>
                        <p><span class="profile-label">Membership:</span> <span class="profile-value"><?= htmlspecialchars($this->memberData['member_type']); ?></span></p>
                        <p><span class="profile-label">Email:</span> <span class="profile-value"><?= htmlspecialchars($this->memberData['member_email']); ?></span></p>
                        <div class="text-center mt-3">
                            <a href="member_dashboard.php" class="btn btn-secondary">Go to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
}

$profile = new MemberProfile($conn, $member_id);
$profile->fetchMemberDetails();
$profile->displayProfile();
?>