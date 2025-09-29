<?php
include 'config.php';
include 'header_all.php';

if (!isset($_GET['member_id']) || empty($_GET['member_id'])) {
    die("Invalid request. Member ID is required.");
}

$member_id = $_GET['member_id']; 

// Fetch data from the borrow_return table for the given member ID
$query = "SELECT issue_date, return_date, mem_rt_date, return_status 
          FROM borrow_return 
          WHERE member_id = $member_id"; 
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Fine Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body {
        background: #f8f9fa;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
      }
      .fine-section {
        max-width: 900px;
        margin: 48px auto 48px auto;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(160,82,45,0.09);
        padding: 40px 32px 32px 32px;
        border: 1px solid #eee;
      }
      .fine-section h1 {
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
      .btn-secondary {
        border-radius: 18px;
        font-weight: 600;
        padding: 8px 24px;
        font-size: 1rem;
      }
      @media (max-width: 900px) {
        .fine-section {
          padding: 18px 8px;
        }
        .table th, .table td {
          font-size: 0.98rem;
        }
      }
    </style>
</head>
<body>
    <div class="fine-section">
        <h1>Fine Details for Member ID: <?= $member_id ?></h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Issue Date</th>
                    <th>Return Date</th>
                    <th>Member Return Date</th>
                    <th>Return Status</th>
                    <th>Delay Time (Days)</th>
                    <th>Fine Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <?php
                        // Initialize variables for fine calculation
                        $issue_date = $row['issue_date'];
                        $return_date = $row['return_date'];
                        $mem_rt_date = $row['mem_rt_date'];
                        $return_status = $row['return_status'];
                        $delay_time = 0;
                        $fine = 0;
                        if (!empty($mem_rt_date)) {
                            if (strtotime($mem_rt_date) > strtotime($return_date)) {
                                $return_date_obj = new DateTime($return_date);
                                $mem_rt_date_obj = new DateTime($mem_rt_date);
                                $delay_time = $mem_rt_date_obj->diff($return_date_obj)->days;
                                $fine = $delay_time * 50;
                            }
                        } else {
                            $delay_time = 0;
                            $fine = 0;
                        }
                        ?>
                        <tr>
                            <td><?= $issue_date ?></td>
                            <td><?= $return_date ?></td>
                            <td><?= $mem_rt_date ?? 'Not Returned' ?></td>
                            <td><?= $return_status ?></td>
                            <td><?= $delay_time ?></td>
                            <td><?= number_format($fine, 2) ?> BDT</td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No records found for this member.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="admin_view_member.php" class="btn btn-secondary">Back to Members</a>
        </div>
    </div>
</body>
</html>
