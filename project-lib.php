<?php


isset($_REQUEST['s']) ? $s = strip_tags($_REQUEST['s']) : $s=""; //Setting variable
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



?>
