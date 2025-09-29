
<?php
include 'config.php';

class Member {
    public $conn;
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
    public function getMemberDetails($member_id) {
        $sql = "SELECT member_name, member_email, member_type, member_password FROM member_details WHERE member_id = $member_id";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function updateMemberDetails($member_id, $name, $email, $type, $password = null) {
        if ($password) {
            $sql = "UPDATE member_details SET 
                        member_name = '$name', 
                        member_email = '$email', 
                        member_type = '$type', 
                        member_password = '$password' 
                    WHERE member_id = $member_id";
        } else {
            $sql = "UPDATE member_details SET 
                        member_name = '$name', 
                        member_email = '$email', 
                        member_type = '$type' 
                    WHERE member_id = $member_id";
        }
        return $this->conn->query($sql);
    }
}

// Example usage (for demo):
$member_id = 1; // Replace with dynamic value
$memberObj = new Member($conn);
$details = $memberObj->getMemberDetails($member_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f8f9fa 60%, #e9ecef 100%);
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .card {
            max-width: 500px;
            margin: 48px auto;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(160,82,45,0.13);
            border: none;
        }
        .card-header {
            background: linear-gradient(90deg, #a0522d 60%, #d2691e 100%);
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            text-align: center;
        }
        .card-body {
            background: #fff;
            padding: 2rem;
        }
        .card-body h5 {
            color: #a0522d;
            font-weight: 600;
        }
        .card-body p {
            font-size: 1.1rem;
            color: #343a40;
        }
        .btn-primary {
            background: #a0522d;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 32px;
            font-size: 1.1rem;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #d2691e;
        }
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: 5vh;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
        }
    </style>
</head>
<body>
    <!-- Modern, Responsive Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #343a40 60%, #6c757d 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="welcome.php" style="font-weight:700; letter-spacing:1px;">
          <img src="images/Digishelf Logo.jpg" alt="Logo" style="height:60px; width:60px; object-fit:cover; margin-right:14px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.08); background:#fff; padding:2px;">
          <span style="font-size:1.5rem; color:#a0522d; letter-spacing:2px;">Digishelf</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="welcome.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="books.php">Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about_us.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact_us.php">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="card">
        <div class="card-header">Member Details</div>
        <div class="card-body">
            <?php if ($details): ?>
                <h5>Name:</h5>
                <p><?= htmlspecialchars($details['member_name']) ?></p>
                <h5>Email:</h5>
                <p><?= htmlspecialchars($details['member_email']) ?></p>
                <h5>Type:</h5>
                <p><?= htmlspecialchars($details['member_type']) ?></p>
            <?php else: ?>
                <div class="alert alert-warning">Member details not found.</div>
            <?php endif; ?>
        </div>
    </div>
    <footer>
        <p>&copy; <?= date('Y') ?> Library Management System. All Rights Reserved.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>