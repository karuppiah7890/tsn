<?php

	session_start();

	$current_file = $_SERVER['SCRIPT_NAME'];
	
	function loggedin()
	{
		if (!empty($_SESSION['user_id'])) {
			return true;
		}
		else
			return false;
	}

	function redirect_if_not_loggedin()
	{
		if(!loggedin())
		{
			header('Location: login.php?m=Please Login');
			die();
		}
	}

	function getUserFieldValue($fieldname)
	{
		global $conn;

		$query = "SELECT `$fieldname` FROM login WHERE `id`=".$_SESSION['user_id']."";

		if($query_run = mysqli_query($conn,$query)){

			$row = mysqli_fetch_assoc($query_run);

			if(!empty($row[$fieldname]))
				return $row[$fieldname];
		}

	}

	function isJournalist()
	{
		if(loggedin())
		{
			if(!empty($_SESSION['user_type']))
			{
				if($_SESSION['user_type']=='jour')
					return true;	
			}
		}

		return false;
	}

	function isEditor()
	{
		if(loggedin())
		{
			if(!empty($_SESSION['user_type']))
			{
				if($_SESSION['user_type']=='edit')
					return true;	
			}
		}

		return false;
	}
?>