<?php

echo"
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
                <nav class='nav nav-pills'>
                <a class='nav-link active' href='index.php'>GO TO HOME PAGE</a>
		</nav>
		</ul>
	 <link href='login.css' rel='stylesheet'>
";
echo"
	<html>
	<form method=post action=tracks.php>
	<table cellspacing='150'>
	<center>
	<h1>LOGIN FORM</h1>
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

	<p>	
	<tr><td><font face ='Georgia'><b> Username: </b></font></td>
	<td><input type=text name=postUser> </td></tr>
	</p>
	<p>
	<tr><td><font face ='Georgia'><b> Password: </b></font></td>
	<td><input type=password name=postPassd> </td></tr>
	</p>
	<p>
	<center> <tr><td text-align='center'><font face ='Georgia'><input type=submit name=submit value=Login> </font></td></tr>
	</p>
	</section>
	</table>
	</form>

	<p> Dont Have an Account With Us?? </p> <br/>
	<a href=tracks.php?s=2 class='btn btn-lg btn-secondary'>SIGN UP</a>
	</html>";
?>
