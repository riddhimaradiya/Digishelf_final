
<?php include 'header_all.php'; ?>
<style>
  body {
    background: #f8f9fa;
    font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
  }
  .page {
    padding-top: 40px;
    padding-bottom: 40px;
    min-height: 80vh;
  }
  .page-title {
    text-align: center;
    color: #a0522d;
    font-weight: 700;
    margin-bottom: 32px;
    letter-spacing: 1px;
    font-size: 2.5rem;
  }
  .card.fade-in {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(160,82,45,0.09);
    border: 1px solid #eee;
    margin-bottom: 32px;
    animation: fadeIn 1s ease;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .card-body {
    padding: 32px 24px;
  }
  .stat-icon {
    font-size: 2.8rem;
    margin-bottom: 18px;
    color: #a0522d;
  }
  .features-grid {
    display: flex;
    gap: 24px;
    flex-wrap: wrap;
    justify-content: center;
    margin-top: 32px;
  }
  .features-grid .card {
    flex: 1 1 280px;
    min-width: 260px;
    max-width: 340px;
  }
  .features-grid h4 {
    color: #a0522d;
    font-weight: 600;
    margin-bottom: 12px;
  }
  .features-grid p {
    color: #3e2723;
    font-size: 1.05rem;
  }
  @media (max-width: 900px) {
    .features-grid {
      flex-direction: column;
      gap: 18px;
    }
  }
</style>
<div class="page">
  <div class="container">
    <h1 class="page-title">About DigiShelf</h1>
    <div class="card fade-in" style="max-width:800px; margin:0 auto;">
      <div class="card-body text-center">
        <div class="stat-icon">
          <i class="fas fa-graduation-cap"></i>
        </div>
        <h3 style="color:#a0522d; font-weight:600;">Empowering Education Through Digital Innovation</h3>
        <p style="font-size:1.1rem; line-height:1.8; margin-top:1rem; color:#3e2723;">
          DigiShelf is a modern e-library management system designed specifically for educational institutions. 
          We provide students and faculty with seamless access to a vast collection of digital resources, 
          making learning more accessible and efficient. Our platform combines the traditional library experience 
          with cutting-edge technology to create an intuitive and engaging digital environment.
        </p>
        <br />
        <p style="color:#bf6b2c; font-weight:bold;">
          Join thousands of readers who have already discovered the future of library management!
        </p>
      </div>
    </div>
    <!-- Features Grid -->
    <div class="features-grid">
      <div class="card fade-in">
        <div class="card-body text-center">
          <div class="stat-icon">
            <i class="fas fa-book-reader" style="color:#3498db;"></i>
          </div>
          <h4>Digital Collection</h4>
          <p>Access thousands of e-books, research papers, and academic resources from anywhere.</p>
        </div>
      </div>
      <div class="card fade-in">
        <div class="card-body text-center">
          <div class="stat-icon">
            <i class="fas fa-users" style="color:#2ecc71;"></i>
          </div>
          <h4>Community Driven</h4>
          <p>Share reviews, recommendations, and connect with fellow readers in your institution.</p>
        </div>
      </div>
      <div class="card fade-in">
        <div class="card-body text-center">
          <div class="stat-icon">
            <i class="fas fa-chart-line" style="color:#f39c12;"></i>
          </div>
          <h4>Analytics & Insights</h4>
          <p>Track your reading progress and discover new books based on your interests.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
