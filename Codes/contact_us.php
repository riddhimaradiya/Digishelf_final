

<?php
include 'config.php';
include 'header_all.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $subject = trim($_POST['subject'] ?? '');
  $msg = trim($_POST['message'] ?? '');
  if ($name && $email && $subject && $msg) {
    if ($conn->connect_error) {
      $message = '<div class="alert alert-danger">Database connection failed.</div>';
    } else {
      $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, NOW())");
      $stmt->bind_param('ssss', $name, $email, $subject, $msg);
      if ($stmt->execute()) {
        $message = '<div class="alert alert-success">Thank you for contacting us!</div>';
      } else {
        $message = '<div class="alert alert-danger">Failed to send message. Please try again.</div>';
      }
      $stmt->close();
    }
  } else {
    $message = '<div class="alert alert-danger">Please fill all fields.</div>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
    }
    .contact-container {
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
    textarea.form-control {
      min-height: 120px;
      resize: vertical;
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
      .contact-container {
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
  <!-- Navigation bar is now included via header.php for consistency -->
  <div class="contact-container">
    <div class="illustration">
  <img src="images/al.jpg" alt="Contact Illustration">
    </div>
    <div class="form-container">
      <h2>Contact Us</h2>
      <?php echo $message; ?>
      <form method="post">
        <div class="mb-3">
          <label for="name" class="form-label">Name*</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email*</label>
          <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="subject" class="form-label">Subject*</label>
          <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message*</label>
          <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Send</button>
      </form>
    </div>
  </div>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <footer class="footer-modern">
    <style>
      .footer-modern {
        background: #363636;
        color: #fff;
        padding: 48px 0 0 0;
        margin-top: 48px;
        border-top-left-radius: 18px;
        border-top-right-radius: 18px;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.08);
      }
      .footer-modern .footer-section-title {
        color: #c5732b;
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 18px;
        text-align: left;
      }
      .footer-modern .footer-desc {
        font-size: 1.15rem;
        color: #e0e0e0;
        margin-bottom: 18px;
        text-align: left;
      }
      .footer-modern .footer-social {
        margin-bottom: 18px;
      }
      .footer-modern .footer-social a {
        display: inline-block;
        width: 48px;
        height: 48px;
        background: #c5732b;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        line-height: 48px;
        font-size: 1.7rem;
        margin: 0 8px;
        transition: background 0.2s;
      }
      .footer-modern .footer-social a:hover {
        background: #a0522d;
        color: #fff;
      }
      .footer-modern .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
      }
      .footer-modern .footer-links li {
        margin-bottom: 10px;
      }
      .footer-modern .footer-links a {
        color: #fff;
        text-decoration: none;
        font-size: 1.1rem;
        transition: color 0.2s;
      }
      .footer-modern .footer-links a:hover {
        color: #c5732b;
        text-decoration: underline;
      }
      .footer-modern .footer-contact {
        font-size: 1.1rem;
        color: #e0e0e0;
        margin-bottom: 10px;
      }
      .footer-modern .footer-contact i {
        color: #c5732b;
        margin-right: 8px;
        font-size: 1.2rem;
      }
      .footer-modern .footer-bottom {
        border-top: 1px solid #444;
        margin-top: 32px;
        padding: 18px 0 8px 0;
        text-align: center;
        color: #fff;
        font-size: 1.15rem;
      }
    </style>
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="footer-section-title">DigiShelf</div>
          <div class="footer-desc">Your trusted digital library management system for modern educational institutions.</div>
          <div class="footer-social">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="footer-section-title">Quick Links</div>
          <ul class="footer-links">
            <li><a href="welcome.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="about_us.php">About</a></li>
            <li><a href="#">Reviews</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <div class="footer-section-title">Contact Info</div>
          <div class="footer-contact"><i class="fas fa-envelope"></i> e-library@digishelf.com</div>
          <div class="footer-contact"><i class="fas fa-phone"></i> +91 1234567890</div>
          <div class="footer-contact"><i class="fas fa-location-dot"></i> SUTEX BANK COLLEGE OF COMPUTER APPLICATION &amp; SCIENCE AMROLI-SURAT.</div>
        </div>
      </div>
      <div class="footer-bottom">
        &copy; <?php echo date('Y'); ?> DigiShelf Reading Club. All rights reserved.
      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
