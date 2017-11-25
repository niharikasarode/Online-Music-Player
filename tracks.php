<?php

include_once('/var/www/html/Project/project-lib.php');
connect($db);

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
                <ul class='nav justify-content-center'>
                <ul class='nav nav-tabs justify-content-center'>
                <li class='nav-item'>
                <a class='nav-link active' href='tracks.php'>TRACKS</a>
                </li>
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
		<ul class='nav nav-tabs justify-content-center'>
  		<li class='nav-item'>
    		<a class='nav-link active' href='tracks.php'>TRACKS</a>
  		</li>
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
		</tr>
  		</thead>
  		<tbody>";
		while($row=mysqli_fetch_row($result))
		{
			echo"<tr><th scope='row'>$row[0]</th>
				<td><img src=$row[3] width='50' height='50'></td> <td>$row[1]</td> <td> $row[5] </td> 
				<td> <audio controls controlsList='nodownload' src =$row[2] > </td>
				<td> $$row[4] </td> </tr>";
		}
		echo"</table>";
		break;


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
		<ul class='nav nav-tabs justify-content-center'>
  		<li class='nav-item'>
    		<a class='nav-link active' href='tracks.php'>ALBUMS</a>
  		</li>
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
		</tr>
		</thead>
		</tbody>";
		while($row=mysqli_fetch_row($result))
		{
		echo"<tr><th scope='row'>$row[0]</th>
                     <td><img src=$row[3] width='50' height='50'></td> <td> <a href=tracks.php?s=4&album=$row[0]>$row[1]</td>
		     <td> $row[4] </td>
		     <td> $row[2] </td></tr>";

		}
		echo"</table>";
		break;


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
                </head>
                <ul class='nav justify-content-center'>
                <ul class='nav nav-tabs justify-content-center'>
                <li class='nav-item'>
                <a class='nav-link active' href='tracks.php'>SIGN UP</a>
                </li>
		<body>";
		
		echo "

			<style>
			p{
				margin-top:300px;
			}
			</style>
			<p><form method=post action=tracks.php></p>
			<table><tr><td> Username: </td>
			<td><input type=\"text\" name=\"newUser\" value=\"\"></td></tr>
			<table><tr><td> Password: </td>
			<td><input type=\"password\" name=\"newPass\" value=\"\"></td></tr>
			<table><tr><td> Email ID: </td>
			<td><input type=\"text\" name=\"newEmail\" value=\"\"></td></tr>
			<r><td><input type=\"hidden\" name=\"s\" value=\"3\">
			<input type=\"submit\" name=\"submit\" value=\"Submit\"></td></tr></table></form>";
			break;		

	
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
		<tr><td align='center'><input type=\"hidden\" name=\"s\" value=\"2\"> </td>
		<input type=\"hidden\" name=\"username\" value=\"$newUser\">
		<input type=\"hidden\" name=\"password\" value=\"$pass\">
		";
		break;


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

}		


}

?>
