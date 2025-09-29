
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
  .footer-modern .footer-title {
    color: #c5732b;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 12px;
    text-align: center;
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<footer class="footer-modern">
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
<!-- Bootstrap and jQuery JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
