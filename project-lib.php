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
isset($_REQUEST['title1'])?$title1=strip_tags($_REQUEST['title1']):$title1="";
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
isset($_REQUEST['order_name'])?$order_name=strip_tags($_REQUEST['order_name']):$order_name="";
isset($_REQUEST['cid'])?$cid = strip_tags($_REQUEST['cid']):$cid=""; //Setting variable
isset($_REQUEST['userid'])?$userid = strip_tags($_REQUEST['userid']):$userid=""; //Setting variable
isset($_REQUEST['price1'])?$price1=strip_tags($_REQUEST['price1']):$price1="";

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

	$_SESSION['ip']=$_SERVER['REMOTE_ADDR'];
	$_SESSION['HTTP_USER_AGENT']= md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT']);
	$_SESSION['created']=time();
	$id = $_SESSION['ip'];
	$fail = 'SEVEN';
	$query = "SELECT ip,COUNT(ip) FROM Login WHERE date > DATE_SUB(NOW(), INTERVAL 1 HOUR) AND action = 'FAIL'";
	$result = mysqli_query($db, $query);
  	while($row = mysqli_fetch_row($result))
	{
		if($row[1] >= 5)
		{
			error_log("Detected 5 failed logins");
        		if($row[0] == $id)
        		{
                		error_log("And from Same IP");
                		$fail = 'FIVE';
        		}

		}
	}
	
	// If there were 5 failed logins from the same IP used to currently login, redirect the user to login n block.
	if($fail == 'FIVE')
	{

                session_destroy();
                header("Location: /Project/login.php");
                exit;
	}





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

function check_auth()
{
	if(isset($_SESSION['HTTP_USER_AGENT']))
	{
		if($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['SERVER_ADDR'].$_SERVER['HTTP_USER_AGENT'])) //logging in using firefox vs chrome
		{
			error_log("here 1", 0);
			header("Location: /Project/login.php");	

		}
	}

	else 
	{
		
			header("Location: /Project/login.php");	
	}


	
	if(isset($_SESSION['ip']))
	{
		
		if($_SESSION['ip'] != $_SERVER['REMOTE_ADDR'])
		{
				
			error_log("here 2",0);
			header("Location: /Project/login.php");	
		}
	}
	else
	{
		header("Location: /Project/login.php");	
	}


	

	if(isset($_SESSION['created'])) // change time to see if it kicks you out
	{
		if( time() - $_SESSION['created'] > 1800)
		{
			header("Location: /Project/login.php");
		}
	}
	else 
	{
		header("Location: /Project/login.php");
	}

	
	if("POST" == $_SERVER["REQUEST_METHOD"])
	{
		if(isset($_SERVER["HTTP_ORIGIN"]))
		{
			if($_SERVER["HTTP_ORIGIN"] != "https://100.66.1.11")
			{
				error_log("Here 3 http origin",0);
				header("Location: /Project/login.php");
			}
		}
		else
		{
			header("Location: /Project/login.php");
		}
	}

}

?>
