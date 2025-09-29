<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Digishelf Reading Club</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
      body {
        background: #fff;
        color: #3e2723;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
      }
      .navbar {
        background: #fff !important;
        border-bottom: 1px solid #eee;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
      }
      .navbar-brand img {
        height: 48px;
        margin-right: 10px;
      }
      .navbar-brand, .navbar-nav .nav-link {
        color: #a0522d !important;
        font-weight: 600;
        letter-spacing: 1px;
      }
      .navbar-brand {
        color: #a0522d !important;
      }
      .navbar-nav .nav-link.active {
        color: #d2691e !important;
      }
      .btn, .form-control {
        border-radius: 24px;
      }
      .carousel-inner img {
        filter: brightness(0.92);
        border-radius: 18px;
      }
      .carousel-caption {
        background: rgba(255,255,255,0.85);
        color: #a0522d;
        border-radius: 16px;
        padding: 24px 32px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
      }
      .carousel-item p {
        color: #333 !important;
      }
      .carousel-caption h2 {
        color: #a0522d;
        font-weight: 700;
      }
      .carousel-indicators li {
        background-color: #a0522d;
      }
      .rounded-circle {
        border: 3px solid #a0522d;
      }
      .card-modern {
        background: #fff;
        border: 1px solid #eee;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(160,82,45,0.07);
        padding: 32px 18px 24px 18px;
        margin-bottom: 24px;
        text-align: center;
        transition: box-shadow 0.3s, transform 0.3s;
        cursor: pointer;
      }
      .card-modern:hover {
        box-shadow: 0 8px 32px rgba(160,82,45,0.18);
        transform: translateY(-8px) scale(1.04);
        border-color: #a0522d;
      }
      .card-modern h2 {
        color: #a0522d;
        font-weight: 700;
      }
      .btn-digi {
        background: #a0522d;
        color: #fff;
        border: none;
        font-weight: 600;
      }
      .btn-digi:hover {
        background: #d2691e;
        color: #fff;
      }
      footer {
        border-top: 1px solid #eee;
        color: #a0522d;
        background: #fff;
        text-align: center;
        padding: 32px 0 0 0;
      }
      .footer-link {
        color: #a0522d;
        text-decoration: underline;
      }
      @media (max-width: 768px) {
        .carousel-caption {
          padding: 12px 8px;
        }
      }
    </style>
</head>
  <body>
  <?php include 'header_all.php'; ?>

  <div id="carouselExampleCaptions" class="carousel slide carousel-fade mt-3" data-ride="carousel">
      <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
          <div class="carousel-item active">
              <img src="images/3.jpg" class="d-block w-100 carousel-img-animate" alt="..." style="width: 1280px; height: 400px; object-fit: cover;">
              <div class="carousel-caption d-none d-md-block">
                  <h2 class="welcome-animate">Welcome to Digishelf</h2>
                  <p class="caption-animate">Explore Infinite Possibilities Through Books and Resources</p>

              </div>
          </div>
          <div class="carousel-item">
              <img src="images/5.jpg" class="d-block w-100 carousel-img-animate" alt="..." style="width: 1280px; height: 400px; object-fit: cover;">
              <div class="carousel-caption d-none d-md-block">
  <h2 class="welcome-animate">Welcome to Digishelf</h2>
          <p class="caption-animate">Explore Infinite Possibilities Through Books and Resources</p>

              </div>
          </div>
          <div class="carousel-item">
              <img src="images/1.jpg" class="d-block w-100 carousel-img-animate" alt="..." style="width: 1280px; height: 400px; object-fit: cover;">
              <div class="carousel-caption d-none d-md-block">
  <h2 class="welcome-animate">Welcome to Digishelf</h2>
          <p class="caption-animate">Explore Infinite Possibilities Through Books and Resources</p>

              </div>
          </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="container my-5">
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card-modern">
            <img class="rounded-circle mb-3" src="images/15.jpg" alt="Members" width="120" height="120">
            <h2>Members</h2>
            <p>Explore a wide range of books, journals, and e-resources. Expand your knowledge effortlessly.</p>
            <a class="btn btn-digi" href="member_login.php" role="button">Log in &rarr;</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card-modern">
            <img class="rounded-circle mb-3" src="images/r1.jpg" alt="Librarian" width="120" height="120">
            <h2>Librarian</h2>
            <p>Manage collections, organize resources, and assist members effectively.</p>
            <a class="btn btn-digi" href="librarian_login.php" role="button">Log in &rarr;</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card-modern">
            <img class="rounded-circle mb-3" src="images/10.jpg" alt="Admin" width="120" height="120">
            <h2>Admin</h2>
            <p>Oversee operations, manage accounts, and ensure smooth library systems.</p>
            <a class="btn btn-digi" href="admin_login.php" role="button">Log in &rarr;</a>
          </div>
        </div>
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
        .welcome-animate {
          opacity: 0;
          transform: translateY(30px);
          animation: fadeSlideUp 1.2s ease-out 0.2s forwards;
        }
        @keyframes fadeSlideUp {
          to {
            opacity: 1;
            transform: translateY(0);
          }
        }
        .caption-animate {
          opacity: 0;
          transform: translateY(30px);
          animation: fadeSlideUp 1.2s ease-out 0.6s forwards;
        }
        .carousel-img-animate {
          animation: slideBg 8s linear infinite alternate;
        }
        @keyframes slideBg {
          0% {
            transform: translateX(0);
          }
          100% {
            transform: translateX(-40px);
          }
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

  <!-- Optional JavaScript -->
  <!-- jQuery, Popper.js, and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
  </body>
</html>
