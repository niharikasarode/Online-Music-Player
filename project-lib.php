<?php


isset($_REQUEST['s'])?$s = strip_tags($_REQUEST['s']):$s=""; //Setting variable
isset($_REQUEST['newEmail'])?$newEmail=strip_tags($_REQUEST['newEmail']):$newEmail="";
isset($_REQUEST['newPass'])?$newPass=strip_tags($_REQUEST['newPass']):$newPass="";
isset($_REQUEST['newUser'])?$newUser=strip_tags($_REQUEST['newUser']):$newUser="";
isset($_REQUEST['pass'])?$pass=strip_tags($_REQUEST['pass']):$pass="";
isset($_REQUEST['salt'])?$salt=strip_tags($_REQUEST['salt']):$salt="";
isset($_REQUEST['album'])?$album=strip_tags($_REQUEST['album']):$album="";
isset($_REQUEST['track_id'])?$track_id=strip_tags($_REQUEST['track_id']):$track_id="";
isset($_REQUEST['title'])?$title=strip_tags($_REQUEST['title']):$title="";
isset($_REQUEST['song_url'])?$song_url=strip_tags($_REQUEST['song_url']):$song_url="";
isset($_REQUEST['price'])?$price=strip_tags($_REQUEST['price']):$price="";
isset($_REQUEST['length'])?$length=strip_tags($_REQUEST['length']):$length="";
isset($_REQUEST['postUser'])?$postUser=strip_tags($_REQUEST['postUser']):$postUser="";
isset($_REQUEST['postPassd'])?$postPassd=strip_tags($_REQUEST['postPassd']):$postPassd="";
isset($_REQUEST['psw_repeat'])?$psw_repeat=strip_tags($_REQUEST['psw_repeat']):$psw_repeat="";
isset($_REQUEST['id'])?$id=strip_tags($_REQUEST['id']):$id="";
isset($_REQUEST['password'])?$password=strip_tags($_REQUEST['password']):$password="";
isset($_REQUEST['user_id'])?$user_id=strip_tags($_REQUEST['user_id']):$user_id="";
isset($_REQUEST['email'])?$email=strip_tags($_REQUEST['email']):$email="";
isset($_REQUEST['epass'])?$epass=strip_tags($_REQUEST['epass']):$epass="";



function check_numeric($num)
{
        if(is_numeric($num))
        {
        return $num;
        }
        else return NULL;

}


function connect(&$db)
{
	$mycnf="/etc/project-mysql.conf";
	if(!file_exists($mycnf))
	{
		echo "ERROR : Config File not Found: $mycnf";
	       	exit;	
	}
	$mysql_ini_array=parse_ini_file($mycnf);
	$db_host=$mysql_ini_array["host"];
	$db_user=$mysql_ini_array["user"];
	$db_pass=$mysql_ini_array["pass"];
	$db_port=$mysql_ini_array["port"];
	$db_name=$mysql_ini_array["dbName"];

	$db=mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
	if(!$db)
	{
		print "Error connecting to Db:" . mysqli_connect_error();
		exit;
	}
}

function authenticate($db, $postUser, $postPassd)
{
	if($stmt=mysqli_prepare($db, "SELECT user_id, email, password, salt FROM Customers WHERE username =?"))
	{
		mysqli_stmt_bind_param($stmt, "s", $postUser);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $user_id, $email, $password, $salt);

		while(mysqli_stmt_fetch($stmt))
		{
			$user_id = htmlspecialchars($user_id);
			$email = htmlspecialchars($email);
			$password = htmlspecialchars($password);
			$salt = htmlspecialchars($salt);
		}
		mysqli_stmt_close($stmt);
	}

	$epass = hash('sha256', $postPassd.$salt);
	
	if($epass == $password)
	{
		$_SESSION['user_id'] = $user_id;
		$_SESSION['email'] = $email;
		$_SESSION['authenticated'] = "yes";
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$auth="PASS";

		if($stmt = mysqli_prepare($db, "INSERT INTO Login SET login_id='', ip=?, user = ?, date=NOW(), action = ?"))
		{
			mysqli_stmt_bind_param($stmt, "sss", $_SESSION['ip'], $postUser, $auth);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

	}

	else if($postUser == "")
	{
		header("Location: /Project/login.php");
	}
	else
	{

		$_SESSION['user_id'] = $user_id;
		$_SESSION['email'] = $email;
		$_SESSION['authenticated'] = "yes";
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$auth="FAIL";

		if($stmt = mysqli_prepare($db, "INSERT INTO Login SET login_id='', ip=?, user = ?, date=NOW(), action = ?"))
		{
			mysqli_stmt_bind_param($stmt, "sss", $_SESSION['ip'], $postUser, $auth);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}

		error_log("**** ERROR **** : The App has failed Login from " .$_SERVER['REMOTE_ADDR'],0);
		session_destroy();
		header("Location: /Project/login.php");
		exit;

	}



}



?>
