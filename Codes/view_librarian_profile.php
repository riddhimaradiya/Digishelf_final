
<?php
include 'config.php';
include 'librarian.php';
session_start();

if (!isset($_SESSION['librarian_id'])) {
    header("Location: librarian_login.php");
    exit();
}

$librarian_id = $_SESSION['librarian_id'];
$librarianObj = new Librarian($conn);
$librarianData = $librarianObj->getLibrarianDetails($librarian_id);
if (!$librarianData) {
    die("Librarian not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Librarian Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .profile-section {
            max-width: 600px;
            margin: 48px auto 48px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px rgba(160,82,45,0.09);
            padding: 40px 32px 32px 32px;
            border: 1px solid #eee;
        }
        .page-title {
            color: #a0522d;
            font-weight: 700;
            text-align: center;
            margin-bottom: 24px;
            font-size: 2.1rem;
            letter-spacing: 1px;
        }
        .profile-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(160,82,45,0.13);
            border: 1px solid #eee;
            padding: 32px 24px;
            text-align: left;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .profile-card:hover {
            box-shadow: 0 8px 32px rgba(160,82,45,0.18);
            transform: translateY(-4px) scale(1.03);
        }
        .profile-card h5 {
            color: #a0522d;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        .profile-card p {
            color: #3e2723;
            font-size: 1.05rem;
            margin-bottom: 18px;
        }
        .back-btn {
            margin-top: 32px;
            text-align: center;
        }
        .btn {
            border-radius: 24px;
            font-weight: 600;
            padding: 10px 32px;
            font-size: 1.08rem;
        }
        @media (max-width: 700px) {
            .profile-section {
                padding: 18px 8px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header_all.php'; ?>
    <div class="profile-section">
        <div class="page-title">Librarian Profile</div>
        <div class="profile-card">
            <h5>Profile Details</h5>
            <hr>
            <p><strong>Name:</strong> <?= htmlspecialchars($librarianData['librarian_name']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($librarianData['librarian_email']); ?></p>
            <p><strong>Account Created:</strong> <?= htmlspecialchars($librarianData['librarian_created']); ?></p>
        </div>
        <div class="back-btn">
            <a href="librarian_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
