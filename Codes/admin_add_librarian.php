<?php
include 'config.php';
include 'header_all.php';

class Librarian {
    public $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function add($name, $email, $password) {
        
        $sql = "INSERT INTO librarian_details (librarian_name, librarian_email, librarian_password) 
                VALUES ('$name', '$email', '$password')";

        if ($this->conn->query($sql)) {
            return "Librarian added successfully!";
        } else {
            return "Error: " . $this->conn->error;
        }
    }
}

// Initialize the Librarian class
$librarian = new Librarian($conn);

$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data directly without sanitization
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Add librarian and display the result message
    $message = $librarian->add($name, $email, $password);
    echo "<script>alert('$message');</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add Librarian</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <style>
            body {
                background: #f8f9fa;
                font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            }
            .add-librarian-section {
                max-width: 480px;
                margin: 48px auto 48px auto;
                background: #fff;
                border-radius: 18px;
                box-shadow: 0 2px 12px rgba(160,82,45,0.09);
                padding: 40px 32px 32px 32px;
                border: 1px solid #eee;
            }
            .add-librarian-section h1 {
                color: #a0522d;
                font-weight: 700;
                text-align: center;
                margin-bottom: 24px;
                font-size: 2.1rem;
                letter-spacing: 1px;
            }
            .add-librarian-section label {
                color: #3e2723;
                font-weight: 500;
                margin-bottom: 6px;
            }
            .add-librarian-section .form-control {
                border-radius: 16px;
                border: 1px solid #a0522d;
                margin-bottom: 18px;
                font-size: 1.05rem;
                padding: 10px 16px;
                background: #fdf6f0;
            }
            .add-librarian-section .btn-primary {
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
            .add-librarian-section .btn-primary:hover {
                background: #d2691e;
            }
            .add-librarian-section .btn-secondary {
                border-radius: 24px;
                font-weight: 600;
                padding: 10px 32px;
                font-size: 1.05rem;
            }
        </style>
</head>
<body>
        <div class="add-librarian-section">
                <h1>Add Librarian</h1>
                <form action="" method="POST">
                        <div class="form-group">
                                <label for="name">Librarian Name</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label for="email">Librarian Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div style="text-align:center;">
                            <button type="submit" class="btn btn-primary">Add Librarian</button>
                        </div>
                </form>
                <div class="text-center mt-4">
                        <a href="admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                </div>
        </div>
</body>
</html>
