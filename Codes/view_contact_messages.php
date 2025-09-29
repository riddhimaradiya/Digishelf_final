<?php
include 'config.php';
session_start();
// Optionally restrict access to admin only
// if (!isset($_SESSION['admin_id'])) { header("Location: admin_login.php"); exit(); }

$result = $conn->query("SELECT name, email, subject, message, created_at FROM contact_messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', 'Roboto', Arial, sans-serif; }
        .messages-section { max-width: 900px; margin: 48px auto; background: #fff; border-radius: 18px; box-shadow: 0 2px 12px rgba(160,82,45,0.09); padding: 40px 32px; border: 1px solid #eee; }
        .page-title { color: #a0522d; font-weight: 700; text-align: center; margin-bottom: 24px; font-size: 2rem; letter-spacing: 1px; }
        table { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px rgba(160,82,45,0.07); }
        th { background: linear-gradient(90deg, #a0522d 60%, #c76c2b 100%); color: #fff; font-weight: 600; }
        td { color: #343a40; }
    </style>
</head>
<body>
    <?php include 'header_all.php'; ?>
    <div class="messages-section">
        <div class="page-title">Contact Messages</div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0) { ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['subject']) ?></td>
                                <td><?= htmlspecialchars($row['message']) ?></td>
                                <td><?= htmlspecialchars($row['created_at']) ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr><td colspan="5" class="text-center">No messages found.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-center mt-3">
                <a href="admin_dashboard.php" class="btn btn-secondary">Go to Dashboard</a>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
