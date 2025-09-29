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

        <!-- Modern, Responsive Navbar -->
        <style>
        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.2s;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link:focus {
            color: #d2691e !important;
        }
        .navbar-nav .nav-link::after {
            content: '';
            display: block;
            width: 0;
            height: 3px;
            background: #d2691e;
            border-radius: 2px;
            transition: width 0.3s;
            position: absolute;
            left: 0;
            bottom: -4px;
        }
        .navbar-nav .nav-link:hover::after, .navbar-nav .nav-link:focus::after {
            width: 100%;
        }
        </style>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #343a40 60%, #6c757d 100%); box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
            <div class="container-fluid">
                <a class="navbar-brand d-flex align-items-center gap-2" href="welcome.php" style="font-weight:700; letter-spacing:1px;">
                    <img src="images/Digishelf Logo.jpg" alt="Logo" style="height:60px; width:60px; object-fit:cover; margin-right:14px; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.08); background:#fff; padding:2px;">
                    <span style="font-size:1.5rem; color:#a0522d; letter-spacing:2px;">Digishelf</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="welcome.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="books.php">Books</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.php">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact_us.php">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    
    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9JoAPpT9wQZfrGIlR9jDomin5lwAKj4Oo2BWW" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFwIhhxjT1HZCv4LKXlq2x04dJH" crossorigin="anonymous"></script>
  </body>
</html>
