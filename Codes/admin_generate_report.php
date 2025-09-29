<?php
include 'config.php';
include 'header_all.php';

class MemberReport {
    public $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function updateReport($memberId, $report) {
        // Update the member_report column for the given member_id
        $sql = "UPDATE member_details SET member_report = '$report' WHERE member_id = $memberId";

        if ($this->conn->query($sql)) {
            return "Member report updated successfully!";
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}

$memberReport = new MemberReport($conn);
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch input data
    $memberId = intval($_POST['member_id']);
    $report = $_POST['report'];

    // Update member report and display the result message
    $message = $memberReport->updateReport($memberId, $report);
    echo "<script>alert('$message');</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Update Member Report</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <style>
            body {
                background: #f8f9fa;
                font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            }
            .report-section {
                max-width: 480px;
                margin: 48px auto 48px auto;
                background: #fff;
                border-radius: 18px;
                box-shadow: 0 2px 12px rgba(160,82,45,0.09);
                padding: 40px 32px 32px 32px;
                border: 1px solid #eee;
            }
            .report-section h1 {
                color: #a0522d;
                font-weight: 700;
                text-align: center;
                margin-bottom: 24px;
                font-size: 2.1rem;
                letter-spacing: 1px;
            }
            .report-section label {
                color: #3e2723;
                font-weight: 500;
                margin-bottom: 6px;
            }
            .report-section .form-control {
                border-radius: 16px;
                border: 1px solid #a0522d;
                margin-bottom: 18px;
                font-size: 1.05rem;
                padding: 10px 16px;
                background: #fdf6f0;
            }
            .report-section textarea.form-control {
                min-height: 120px;
                resize: vertical;
            }
            .report-section .btn-primary {
                background: #a0522d;
                border: none;
                border-radius: 24px;
                font-weight: 600;
                padding: 10px 32px;
                font-size: 1.1rem;
                transition: background 0.2s;
                display: block;
                margin: 0 auto;
            }
            .report-section .btn-primary:hover {
                background: #d2691e;
            }
            .report-section .btn-secondary {
                border-radius: 24px;
                font-weight: 600;
                padding: 10px 32px;
                font-size: 1.05rem;
            }
        </style>
</head>
<body>
        <div class="report-section">
                <h1>Update Member Report</h1>
                <form action="" method="POST">
                        <div class="form-group">
                                <label for="member_id">Member ID</label>
                                <input type="number" name="member_id" id="member_id" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label for="report">Report Description</label>
                                <textarea name="report" id="report" rows="5" class="form-control" required></textarea>
                        </div>
                        <div style="text-align:center;">
                            <button type="submit" class="btn btn-primary mt-3">Send Report</button>
                        </div>
                </form>
                <div class="text-center mt-4">
                        <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                </div>
        </div>
</body>
</html>