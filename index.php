<?php
include_once('/var/www/html/Project/project-lib.php');
echo"
<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <link rel='icon' href='/bootstrap-4.0.0-beta.2/favicon.ico'>

    <title>Online Music Store</title>
    
    <!-- Bootstrap core CSS -->
    <link href='/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css' rel='stylesheet'>

    <!-- Custom styles for this template -->
    <link href='/bootstrap-4.0.0-beta.2/docs/4.0/examples/cover/cover.css' rel='stylesheet'>
  </head>

  <body>

    <div class='site-wrapper'>

      <div class='site-wrapper-inner'>

        <div class='cover-container'>

          <header class='masthead clearfix'>
            <div class='inner'>
	      <h3 class='masthead-brand'></h3>
	      <ul class='nav justify-content-center'>
		<nav class='navbar navbar-inverse bg-primary'>
              <nav class='nav nav-pills nav-fill nav-justified'>
                <a class='nav-link active' href=index.html>Home</a>
                <a class='nav-link' href=tracks.php?s=0>Top Charts</a>
                <a class='nav-link' href=tracks.php?s=1>Albums</a>
	        <a class='nav-link' href=tracks.php>Sign In</a>
	        <a class='nav-link' href=tracks.php?s=7>View Orders</a>
	        <a class='nav-link' href=tracks.php?s=50>Logout</a>
		</nav>
            </div>
	  </header>

    <main role='main' class='inner cover'>
            <h1 style='font-size:650%;' class='cover-heading'>Online Music Store</h1>
            <p class='lead'><blockquote> View.. Listen .. Buy.. </blockquote></p>
            <p class='lead'>
              <a href=tracks.php?s=2 class='btn btn-lg btn-secondary'>SIGN UP</a>
            </p>
          </main>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js' integrity='sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN' crossorigin='anonymous'></script>
    <script>window.jQuery || document.write('<script src='/bootstrap-4.0.0-beta.2/assets/js/vendor/jquery.min.js'><\/script>')</script>
    <script src='/bootstrap-4.0.0-beta.2/assets/js/vendor/popper.min.js'></script>
    <script src='/bootstrap-4.0.0-beta.2/dist/js/bootstrap.min.js'></script>
  </body>
  </html>
";
?>

