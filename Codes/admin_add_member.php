<?php
include 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['member_name']);
    $email = trim($_POST['member_email']);
    $password = trim($_POST['member_password']);
    $created = date('Y-m-d H:i:s');

    if ($name && $email && $password) {
        $sql = "INSERT INTO member_details (member_name, member_email, member_password, member_created) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $password, $created);
        if ($stmt->execute()) {
            $success_message = "Member added successfully!";
        } else {
            $error_message = "Failed to add member.";
        }
        $stmt->close();
    } else {
        $error_message = "All fields are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .add-member-section {
            max-width: 500px;
            margin: 48px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(160,82,45,0.13);
            padding: 40px 32px;
            border: 1px solid #eee;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .add-member-section:hover {
            box-shadow: 0 8px 32px rgba(160,82,45,0.18);
            transform: translateY(-4px) scale(1.03);
        }
        .form-title {
            color: #a0522d;
            font-weight: 700;
            text-align: center;
            margin-bottom: 24px;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .form-label {
            color: #a0522d;
            font-weight: 600;
            font-size: 1.08rem;
        }
        .form-control {
            border-radius: 10px;
            font-size: 1.08rem;
            padding: 10px 16px;
        }
        .btn {
            border-radius: 24px;
            font-weight: 600;
            padding: 10px 32px;
            font-size: 1.08rem;
            background: linear-gradient(90deg, #a0522d 60%, #c76c2b 100%);
            border: none;
        }
        .btn:hover {
            background: linear-gradient(90deg, #c76c2b 60%, #a0522d 100%);
        }
        .alert {
            border-radius: 8px;
            font-size: 1rem;
        }
        @media (max-width: 600px) {
            .add-member-section {
                padding: 18px 8px;
            }
        }
    </style>
</head>
<body>
    <?php include 'header_all.php'; ?>
    <div class="add-member-section">
        <div class="form-title">Add Member</div>
        <?php if ($success_message) { ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php } ?>
        <?php if ($error_message) { ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php } ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="member_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="member_name" name="member_name" required>
            </div>
            <div class="mb-3">
                <label for="member_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="member_email" name="member_email" required>
            </div>
            <div class="mb-3">
                <label for="member_password" class="form-label">Password</label>
                <input type="password" class="form-control" id="member_password" name="member_password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Member</button>
        </form>
        <div class="text-center mt-3">
            <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
