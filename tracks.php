<?php
session_start();
include_once('/var/www/html/Project/project-lib.php');
connect($db);

if(($s != 2) && ($s !=3))
{
if(!isset($_SESSION['authenticated']))
{
	authenticate($db, $postUser, $postPassd);
}

check_auth();
}
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
    <link href='tracks.css' rel='stylesheet'>
  </head>

";

if($s == NULL)
{

		echo"
                <!doctype html>
                <html lang='en'>
                <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <meta name='description' content=''>
                <meta name='author' content=''>
                <link rel='icon' href='/bootstrap-4.0.0-beta.2/favicon.ico'>


                <!-- Bootstrap core CSS -->
                <link href='/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css' rel='stylesheet'>

                <!-- Custom styles for this template -->
                <link href='tracks.css' rel='stylesheet'>
                </head>
		<ul class='nav justify-content-end'>
                <nav class='nav nav-pills nav-fill nav-justified'>
                <a class='nav-link active' href='tracks.php'>TRACKS</a>
		<a class='nav-link' href=index.php>HOME</a>
		<a class='nav-link' href=tracks.php?s=50>LOGOUT</a>
		<body>";
	
	
	
	
		$query="SELECT t.track_id, t.title, t.song_url, a.cover_url, t.price FROM Tracks t, Albums a WHERE t.album_id = a.album_id";
                $result=mysqli_query($db, $query);
                echo "<table class='table table-striped'>
                <thead>
                <tr>
                <th>#</th>
                <th>Cover Image</th>
                <th>Track title</th>
                <th>Listen</th>
                <th>Price</th>
                </tr>
                </thead>
                <tbody>";
                while($row=mysqli_fetch_row($result))
                {
                        echo"<tr><th scope='row'>$row[0]</th>
                                <td><img src=$row[3] width='50' height='50'></td> <td>$row[1]</td>
                                <td> <audio controls controlsList='nodownload' src =$row[2] > </td>
                                <td> $$row[4] </td> </tr>";
                }
                echo"</table>";	
}
elseif(is_numeric($s))
{
switch($s)
{

		//tracks
	case 0:
	default:

		echo"
		<!doctype html>
		<html lang='en'>
		<head>
	   	<meta charset='utf-8'>
    		<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    		<meta name='description' content=''>
    		<meta name='author' content=''>
    		<link rel='icon' href='/bootstrap-4.0.0-beta.2/favicon.ico'>


    		<!-- Bootstrap core CSS -->
    		<link href='/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css' rel='stylesheet'>

    		<!-- Custom styles for this template -->
    		<link href='tracks.css' rel='stylesheet'>
		</head>
		
		<ul class='nav justify-content-center'>
		<nav class='nav nav-pills nav-fill nav-justified'>
		<a class='nav-link active' href='tracks.php'>TRACKS</a>
		</nav>
                </ul>
                <ul class='nav justify-content-end'>
                <nav class='navbar navbar-inverse bg-primary'>
		<a class='nav-link' href=index.php>HOME</a>
		<a class='nav-link' href=tracks.php?s=50>LOGOUT</a>
		</nav>
		</ul>
		<body>";
	
	
	
		$query="SELECT t.track_id, t.title, t.song_url, a.cover_url, t.price, t.length FROM Tracks t, Albums a WHERE t.album_id = a.album_id";
		$result=mysqli_query($db, $query);
		echo "<table class='table table-striped'>
		<thead>
    		<tr>
      		<th>#</th>
      		<th>Cover Image</th>
		<th>Track title</th>
		<th>Length</th>
		<th>Listen</th>
		<th>Price</th>
		<th>Order</th>
		</tr>
  		</thead>
  		<tbody>";
		while($row=mysqli_fetch_row($result))
		{
			echo"<tr><th scope='row'>$row[0]</th>
				<td><img src=$row[3] width='50' height='50'></td> <td>$row[1]</td> <td> $row[5] </td> 
				<td> <audio controls controlsList='nodownload' src =$row[2] > </td>
				<td> $$row[4] </td> <td> <a href=tracks.php?s=5&order_name=$row[0]> BUY </a>  </td> </tr>";
		}
		echo"</table>";
		break;

		//ALBUMS
	case 1:
		
		
		echo"
		<!doctype html>
		<html lang='en'>
		<head>
	   	<meta charset='utf-8'>
    		<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    		<meta name='description' content=''>
    		<meta name='author' content=''>
    		<link rel='icon' href='/bootstrap-4.0.0-beta.2/favicon.ico'>


    		<!-- Bootstrap core CSS -->
    		<link href='/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css' rel='stylesheet'>

    		<!-- Custom styles for this template -->
    		<link href='tracks.css' rel='stylesheet'>
 	 	</head>
		<ul class='nav justify-content-center'>
		<nav class='nav nav-pills nav-fill nav-justified'>
		<a class='nav-link active' href='tracks.php'>ALBUMS</a>
		</nav>
		</ul>
		<ul class='nav justify-content-end'>
		<nav class='navbar navbar-inverse bg-primary'>
		<a class='nav-link' href=index.php>HOME</a>
		<a class='nav-link' href=tracks.php?s=50>LOGOUT</a>
		</nav>
		</ul>
		<body>";

		
		
		$query1="SELECT a.album_id, a.title, a.price, a.cover_url, b.name FROM Albums a, Artists b WHERE a.artist_id = b.artist_id";
		$result=mysqli_query($db, $query1);
		echo "<table class='table table-striped'>
		<thead>
		<tr>
		<th>#</th>
		<th>Cover Image</th>
		<th>Albums</th>
		<th>Artist</th>
		<th>Price</th>
		<th>View Album</th>
		<th>Order</th>
		</tr>
		</thead>
		</tbody>";
		while($row=mysqli_fetch_row($result))
		{
		echo"<tr><th scope='row'>$row[0]</th>
		     <td><img src=$row[3] width='50' height='50'></td> <td>$row[1]</td>
		     <td> $row[4] </td>
		     <td> $row[2] </td>	
		     <td> <a href=tracks.php?s=4&album=$row[0]>$row[1]</td><td> <a href=tracks.php?s=6&order_name=$row[0]>BUY</a></td></tr>";

		}
		echo"</table>";
		break;

	// form for sign up
	case 2:
		echo"
                <!doctype html>
                <html lang='en'>
                <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <meta name='description' content=''>
                <meta name='author' content=''>
                <link rel='icon' href='/bootstrap-4.0.0-beta.2/favicon.ico'>


                <!-- Bootstrap core CSS -->
                <link href='/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css' rel='stylesheet'>

                <!-- Custom styles for this template -->
                <link href='tracks.css' rel='stylesheet'>
		<link href='login.css' rel='stylesheet'>
		</head>
	        <ul class='nav justify-content-center'>
                <nav class='nav nav-pills'>	
		<a class='nav-link active' href='tracks.php'>SIGN UP</a>
		<a class='nav-link' href='index.php'>GO TO HOME PAGE</a>
		</nav>
		</ul>
		<body>";
		
		echo "
			
			<form method=post action=tracks.php>
			<table cellspacing='150'>
        		<center>
        		<h1>SIGN UP!</h1>
        		<p>Required fields are followed by <strong><abbr title=\"required\">*</abbr></strong>.</p>

        		<section>
    			<h2>Contact information</h2>
    			<fieldset>
      			<legend>Title</legend>
      			<ul>
          		<li>
            		<label for=\"title_1\">
              		<input type=\"radio\" id=\"title_1\" name=\"title\" value=\"M.\" >
              		Mister
            		</label>
          		</li>
          		<li>
            		<label for=\"title_2\">
              		<input type=\"radio\" id=\"title_2\" name=\"title\" value=\"Ms.\">
              		Miss
            		</label>
          		</li>
      			</ul>
    			</fieldset>

			<table><tr><td> Username: </td>
			<td><input type=\"text\" name=\"newUser\" value=\"\"></td></tr>
			<tr><td> Password: </td>
			<td><input type=\"password\" name=\"newPass\" value=\"\"></td></tr>
			<tr><td> Email ID: </td>
			<td><input type=\"text\" name=\"newEmail\" value=\"\"></td></tr>
			<tr><td><input type=\"hidden\" name=\"s\" value=\"3\">
			<input type=\"submit\" name=\"submit\" value=\"Submit\"></td></tr></table></form>";
			break;		

		//insert signing up info into Customers table	
	case 3:
		$newUser=mysqli_real_escape_string($db,$newUser);
		$newPass=mysqli_real_escape_string($db,$newPass);
		$newEmail=mysqli_real_escape_string($db,$newEmail);
		$salt = rand();
		$pass = hash('sha256',$newPass.$salt);
		
		if($stmt = mysqli_prepare($db,"INSERT INTO Customers SET user_id='',username=?,password=?,email=?,salt=?"))
		{
			mysqli_stmt_bind_param($stmt, "ssss", $newUser, $pass, $newEmail, $salt);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
		else echo"ERROR Inserting into table";
		echo "
		<form method=post action=tracks.php>
		<table><tr><td><input type=\"hidden\" name=\"s\" value=\"2\">
		<p><text-align: 'center'><a href=tracks.php?s=2>Sign up As Different User</a><br/>
		<a href=index.php>Home</a><br/></p>
		";
		break;

		/*List songs under an album*/
	case 4:

		echo"
                <!doctype html>
                <html lang='en'>
                <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <meta name='description' content=''>
                <meta name='author' content=''>
                <link rel='icon' href='/bootstrap-4.0.0-beta.2/favicon.ico'>


                <!-- Bootstrap core CSS -->
                <link href='/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css' rel='stylesheet'>

                <!-- Custom styles for this template -->
                <link href='tracks.css' rel='stylesheet'>
                </head>
                <ul class='nav justify-content-center'>
                <ul class='nav nav-tabs justify-content-center'>
                <li class='nav-item'>
                <a class='nav-link active' href='tracks.php'>Album Contents</a>
                </li>
		<body>";

		echo"
                <table class='table table-striped'>
                <thead>
                <tr>
                <th>#</th>
		<th>Title</th>
		<th>Listen</th>
		<th>Price</th>
		<th>Length</th>
                </tr>
                </thead>
                <tbody>
		";

		$album=mysqli_real_escape_string($db,$album);
		if($stmt = mysqli_prepare($db,"SELECT  track_id, title, song_url, price, length FROM Tracks WHERE album_id=?"))		
		{
			mysqli_stmt_bind_param($stmt, "i", $album);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt,$track_id, $title, $song_url, $price, $length);
			while(mysqli_stmt_fetch($stmt))
			{
			$track_id = htmlspecialchars($track_id);
			$title = htmlspecialchars($title);
			$song_url = htmlspecialchars($song_url);
			$price = htmlspecialchars($price);
			$length = htmlspecialchars($length);

			echo"<tr><th scope='row'>$track_id</th>
                                <td>$title</td>
                                <td> <audio controls controlsList='nodownload' src =$song_url> </td>
                                <td> $$price </td> <td> $length </td> </tr>";
			
			}
			mysqli_stmt_close($stmt);
		}

		else
		{
			echo "Error!";
		}
		break;

		
		//inserting into orders table (tracks)
	case 5:
		$order_name=mysqli_real_escape_string($db, $order_name);
		$cid=$_SESSION['user_id'];
		
		error_log("From cases : $order_name, $cid");
		
		if($stmt = mysqli_prepare($db,"SELECT title, price FROM Tracks WHERE track_id=?"))
                {
                        mysqli_stmt_bind_param($stmt, "s", $order_name);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt,$title1,$price1);
                        while(mysqli_stmt_fetch($stmt))
                        {
                        $title1 = htmlspecialchars($title1);
                        $price1 = htmlspecialchars($price1);

                        }
                        mysqli_stmt_close($stmt);
                }

                else
                {
                        echo "Error!";
                }



		if($stmt = mysqli_prepare($db,"INSERT INTO Orders SET order_id='',customer_id=?, order_name=?, price=?, date=NOW()"))
                {
                        mysqli_stmt_bind_param($stmt, "isi", $cid, $title1, $price1);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                }
                else echo"ERROR Inserting into table";
                echo "
		
		<link href='login.css' rel='stylesheet'>
		<form method=post action=tracks.php>
		<table>
		<p><tr><td style='padding-left:55px;padding-bottom:30px;font-size:40px;font-family:Georgia'><a href=tracks.php?s=0>Buy Another song</a><br/></td></tr></p>
                <p><tr><td style='padding-left:55px;padding-bottom:30px;font-size:40px;font-family:Georgia'><a href=tracks.php?s=1>Buy Another Album</a><br/></td></tr></p>
                <p><tr><td style='padding-left:55px;padding-bottom:30px;font-size:40px;font-family:Georgia'><a href=index.php>Home</a><br/></td></tr></p>


		";
                break;
	


		
		//inserting into orders table (albums)
	case 6:
		$order_name=mysqli_real_escape_string($db, $order_name);
		$cid=$_SESSION['user_id'];
		
		error_log("From cases : $order_name, $cid");
		
		if($stmt = mysqli_prepare($db,"SELECT title, price FROM Albums WHERE album_id=?"))
                {
                        mysqli_stmt_bind_param($stmt, "s", $order_name);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_bind_result($stmt,$title1,$price1);
                        while(mysqli_stmt_fetch($stmt))
                        {
                        $title1 = htmlspecialchars($title1);
                        $price1 = htmlspecialchars($price1);

                        }
                        mysqli_stmt_close($stmt);
                }

                else
                {
                        echo "Error!";
                }



		if($stmt = mysqli_prepare($db,"INSERT INTO Orders SET order_id='',customer_id=?, order_name=?, price=?, date=NOW()"))
                {
                        mysqli_stmt_bind_param($stmt, "isi", $cid, $title1, $price1);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                }
                else echo"ERROR Inserting into table";
                echo "
		<style>
		p{
			margin-top:100px;
		}
		</style>	
		<link href='login.css' rel='stylesheet'>
                <form method=post action=tracks.php>
                <table>
                <p><tr><td style='padding-left:55px;padding-bottom:30px;font-size:40px;font-family:Georgia'><a href=tracks.php?s=0>Buy Another song</a><br/></td></tr></p>
                <p><tr><td style='padding-left:55px;padding-bottom:30px;font-size:40px;font-family:Georgia'><a href=tracks.php?s=1>Buy Another Album</a><br/></td></tr></p>
                <p><tr><td style='padding-left:55px;padding-bottom:30px;font-size:40px;font-family:Georgia'><a href=index.php>Home</a><br/></td></tr></p>


		";
                break;

		// view orders(all orders for all customers) for admin
	case 7:
		if($_SESSION['user_id'] == 1)
		{
			echo"
                <!doctype html>
                <html lang='en'>
                <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <meta name='description' content=''>
                <meta name='author' content=''>
                <link rel='icon' href='/bootstrap-4.0.0-beta.2/favicon.ico'>


                <!-- Bootstrap core CSS -->
                <link href='/bootstrap-4.0.0-beta.2/dist/css/bootstrap.min.css' rel='stylesheet'>

                <!-- Custom styles for this template -->
                <link href='tracks.css' rel='stylesheet'>
                </head>
                <ul class='nav justify-content-center'>
                <nav class='nav nav-pills nav-fill nav-justified'>
                <a class='nav-link active' href='tracks.php'>ORDERS</a>
                </nav>
                </ul>
                <ul class='nav justify-content-end'>
                <nav class='navbar navbar-inverse bg-primary'>
                <a class='nav-link' href=index.php>HOME</a>
                <a class='nav-link' href=tracks.php?s=50>LOGOUT</a>
                </nav>
                </ul>
                <body>";
		
			$query = "SELECT o.order_id, o.order_name, o.price, o.date, c.username FROM Orders o, Customers c WHERE o.customer_id=c.user_id";
			$result=mysqli_query($db, $query);
                	echo "<table class='table table-striped'>
                	<thead>
                	<tr>
                	<th>#</th>
			<th>Customer Username</th>
			<th>Item</th>
                	<th>Price</th>
                	<th>Date ordered</th>
                	</tr>
                	</thead>
                	<tbody>";
               		 while($row=mysqli_fetch_row($result))
			 {
				echo"<tr><th scope='row'>$row[0]</th>
					<td>$row[4]</td> <td>$row[1] </td> <td>$row[2]</td> <td>$row[3]</td></tr>";
			}
		}

		else 
		{
			echo "<link href='login.css' rel='stylesheet'>
                <form method=post action=tracks.php>
		<table>
		<p> You are not Admin! </p>
		<p><tr><td style='padding-left:55px;padding-bottom:30px;font-size:40px;font-family:Georgia'><a href=index.php>Home</a><br/></td></tr></p>
		";
		}
		break;


	case 50:
		session_destroy();
		header("Location: /Project/login.php");
		exit;
}		


}

?>
