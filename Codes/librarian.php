
<?php
include 'config.php';

class Librarian {
    private $conn;
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
    public function getLibrarianDetails($librarian_id) {
        $sql = "SELECT librarian_name, librarian_email, librarian_created FROM librarian_details WHERE librarian_id = $librarian_id";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function updateLibrarianDetails($librarian_id, $name, $email, $password = null) {
        if ($password) {
            $sql = "UPDATE librarian_details SET 
                        librarian_name = '$name', 
                        librarian_email = '$email', 
                        librarian_password = '$password' 
                    WHERE librarian_id = $librarian_id";
        } else {
            $sql = "UPDATE librarian_details SET 
                        librarian_name = '$name', 
                        librarian_email = '$email' 
                    WHERE librarian_id = $librarian_id";
        }
        return $this->conn->query($sql);
    }
}

// Example usage (for demo):
$librarian_id = 1; // Replace with dynamic value
$librarianObj = new Librarian($conn);
$details = $librarianObj->getLibrarianDetails($librarian_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f8f9fa 60%, #e9ecef 100%);
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }
        /* .card styles removed since card is gone */
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
    </style>
</head>
<body>
    <!-- Duplicate navigation bar removed as requested -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
