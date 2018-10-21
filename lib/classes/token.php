<?php

/**
* 
*/
class Token
{
	
	public static function getToken()
	{
		if(!isset($_SESSION['user_token']))
		{
			$_SESSION['user_token'] = md5(uniqid());
		}
	}

	public static function checktoken($token)
	{
		if($token != $_SESSION['user_token'])
		{
			header("Location: 404.php");
			exit;
		}
		else
		{
			self::destroytoken();
		}

	}

	public static function getTokenfield()
	{
		return '<input type="hidden" name="token" value="'.$_SESSION['user_token'].'"/>';
	}

	public static function destroytoken()
	{
		unset($_SESSION['user_token']);
	}
}

?>