<?php

include 'config.php';
include 'header_all.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $member_name = $_POST['member_name']; 
    $password = $_POST['password']; 

    // Check if inputs are not empty
    if (!empty($member_name) && !empty($password)) {
    
        $sql = "SELECT * FROM member_details WHERE member_name = '$member_name'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $member = $result->fetch_assoc();

            // Compare password
            if ($password === $member['member_password']) {
                // Set session variables
                $_SESSION['member_id'] = $member['member_id'];
                $_SESSION['member_name'] = $member['member_name'];
                $_SESSION['member_type'] = $member['member_type'];

                // Redirect to member dashboard
                header("Location: member_dashboard.php");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Member not found.";
        }
    } else {
        $error = "Member Name and Password cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        .login-container {
            max-width: 900px;
            margin: 48px auto 48px auto;
            min-height: 70vh;
            display: flex;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 18px rgba(160,82,45,0.13);
            background: #fff;
        }
        .illustration {
            background: linear-gradient(120deg, #a0522d 60%, #d2691e 100%);
            color: white;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            min-width: 320px;
        }
        .illustration img {
            width: 80%;
            max-width: 320px;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.09);
        }
        .form-container {
            flex: 1;
            background: #fff;
            padding: 48px 32px 32px 32px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .form-container h2 {
            margin-bottom: 30px;
            color: #a0522d;
            font-weight: 700;
            text-align: center;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        .form-label {
            color: #3e2723;
            font-weight: 500;
            margin-bottom: 6px;
        }
        .form-control {
            border-radius: 16px;
            border: 1px solid #a0522d;
            margin-bottom: 18px;
            font-size: 1.05rem;
            padding: 10px 16px;
            background: #fdf6f0;
        }
        .btn-primary {
            background: #a0522d;
            border: none;
            border-radius: 24px;
            font-weight: 600;
            padding: 10px 32px;
            font-size: 1.1rem;
            transition: background 0.2s;
            margin-top: 8px;
        }
        .btn-primary:hover {
            background: #d2691e;
        }
        .alert {
            border-radius: 12px;
            font-size: 1rem;
            margin-bottom: 18px;
            text-align: center;
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
        @media (max-width: 900px) {
            .login-container {
                flex-direction: column;
                min-width: 320px;
            }
            .illustration {
                min-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="illustration">
            <img src="images/m.jpg" alt="Illustration">
        </div>
        <div class="form-container">
            <h2>Member Login</h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger text-center"><?= $error ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="member_name" class="form-label">Member Name</label>
                    <input type="text" name="member_name" id="member_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
