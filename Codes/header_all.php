<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Library Management</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
    <style>
      .navbar-nav .nav-link {
        transition: background 0.18s, color 0.18s, border-radius 0.18s;
        border-radius: 8px;
      }
      .navbar-nav .nav-link:hover, .navbar-nav .nav-link:focus {
        background: #a0522d;
        color: #fff !important;
        border-radius: 8px;
      }
      .navbar form .btn {
        border-radius: 18px;
        color: #a0522d;
        border-color: #a0522d;
        font-weight: 600;
        background: #fff;
        transition: background 0.18s, color 0.18s;
      }
      .navbar form .btn:hover, .navbar form .btn:focus {
        background: #a0522d;
        color: #fff;
        border-color: #a0522d;
      }
    </style>
    <!-- Modern, Responsive Navbar -->
    <nav class="navbar navbar-expand-lg" style="background: #fff; box-shadow: 0 2px 8px rgba(160,82,45,0.08);">
      <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center gap-2" href="welcome.php" style="font-weight:700; letter-spacing:1px; color:#a0522d;">
          <img src="images/Digishelf Logo.jpg" alt="Logo" style="height:60px; width:60px; object-fit:cover; margin-right:14px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.08); background:#fff; padding:2px;">
          <span style="font-size:1.5rem; color:#a0522d; letter-spacing:2px;">Digishelf</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="welcome.php" style="color:#a0522d; font-weight:600;">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="books.php" style="color:#a0522d; font-weight:600;">Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about_us.php" style="color:#a0522d; font-weight:600;">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact_us.php" style="color:#a0522d; font-weight:600;">Contact Us</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0 d-flex" action="books.php" method="get" style="max-width:320px; width:100%;">
            <input class="form-control mr-sm-2 flex-grow-1" type="search" name="search" placeholder="Search books..." aria-label="Search" style="border-radius:18px; border:1px solid #a0522d; background:#fdf6f0;">
            <button class="btn my-2 my-sm-0 ml-2" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9JoAPpT9wQZfrGIlR9jDomin5lwAKj4Oo2BWW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFwIhhxjT1HZCv4LKXlq2x04dJH" crossorigin="anonymous"></script>
  </body>
</html>
