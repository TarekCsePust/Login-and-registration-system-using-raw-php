<?php
	
	/**
	* 
	*/
	class Database 
	{
		private $hostdb = "localhost";
		private $userdb = "admin";
		private $passdb = "";
		private $namedb = "log_reg";
		public $pdo;
		function __construct()
		{
			if(!isset($this->pdo))
			{
				try
				{
					$link = new PDO("mysql:host=".$this->hostdb.";dbname=".$this->namedb,$this->userdb,$this->passdb);
					$link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					$this->pdo = $link;
				}
				catch(PDOException $e)
				{
					die("Database connention is failed".$e->getMessage());
				}
				
			}
		}
	}
?>