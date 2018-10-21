<?php
	
	include_once 'Session.php';
	include 'Database.php';

	class User
	{
		private $db;
		function __construct()
		{
			$this->db = new Database();
			# code...
		}

		public function userRegistration($data)
		{
			$name = $data['name'];
			$username = $data['username'];
			$email = $data['email'];

			$email_check = $this->emailCheck($email);
			if(strlen($data['pass'])<4)
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! password  is too short.
				</strong></div>";
				return $msg;
			}
			$pass = md5($data['pass']);

			if($name == "" || $username == "" || $email== "" || $pass=="")
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! field must not be empty
				</strong.</div>";
				return $msg;
			}
			if(strlen($username)<3)
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! username is too short.
				</strong></div>";
				return $msg;
			}
			elseif (preg_match('/[^a-z0-9_-]+/i',$username)) {
				# code...
				$msg = "<div class='alert alert-danger'><strong>
				Error! username must only content alphanumerical,dahes and under.
				</strong></div>";
				return $msg;
			}


			if(filter_var($email,FILTER_VALIDATE_EMAIL) === false )
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! the email address is not valid.
				</strong></div>";
				return $msg;
			}

			if($email_check == true)
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! the email address is already exist.
				</strong></div>";
				return $msg;
			}

			$sql = "insert into tbl_user
			(Name,Username,Email,Password)values(:name,:username,:email,:pass)";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':name',$name);
			$query->bindValue(':username',$username);
			$query->bindValue(':email',$email);
			$query->bindValue(':pass',$pass);
			$result = $query->execute();
			if($result)
			{
				$msg = "<div class='alert alert-success'><strong>
				You have been registerd.
				</strong></div>";
				return $msg;
			}
			else
			{
				$msg = "<div class='alert alert-success'><strong>
				There has been problem inserting
				</strong></div>";
				return $msg;
			}
		}

		public function emailCheck($email)
		{
			$sql = "select Email from tbl_user where Email = :email";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email',$email);
			$query->execute();
			if($query->rowCount()>0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}


		public function userLogin($data)
		{
			$email = $data['email'];
			$pass = md5($data['pass']);
			$email_check = $this->emailCheck($email);

			if($email== "" || $pass=="")
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! field must not be empty
				</strong.</div>";
				return $msg;
			}

			if(filter_var($email,FILTER_VALIDATE_EMAIL) === false )
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! the email address is not valid.
				</strong></div>";
				return $msg;
			}

			if($email_check == false)
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! the email address is not exist.
				</strong></div>";
				return $msg;
			}

			$result = $this->getloginuser($email,$pass);
			if($result)
			{
				Session::init();
				Session::set("login",true);
				Session::set("id",$result->id);
				Session::set("name",$result->Name);
				Session::set("username",$result->Username);
				Session::set("loginmsg","<div class='alert alert-success'><strong>
				You are loggedin.
				</strong></div>");
				if(isset($data['remember']) && $data['remember']==1)
				{
					setcookie("login","1",time()+365*24*60*60);
				}
				header("Location: index.php");
			}
			


		}


		public function getloginuser($email,$pass)
		{
			$sql = "select * from tbl_user where Email = :email AND Password =:pass";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':email',$email);
			$query->bindValue(':pass',$pass);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}

		public function getUserdata()
		{
			$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
			$query = $this->db->pdo->prepare($sql);
			$query->execute();
			//$result = $query->fetchAll(); prev statement
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			return $result;
		}


		public function getUserById($userid)
		{
			$sql = "SELECT * FROM tbl_user WHERE id=:id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':id',$userid);
			$query->execute();
			$result = $query->fetch(PDO::FETCH_OBJ);
			return $result;
		}


		public function userUpdate($data,$userid)
		{
			$name = $data['name'];
			$username = $data['username'];
			$email = $data['email'];

			
			

			if($name == "" || $username == "")
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! field must not be empty
				</strong.</div>";
				return $msg;
			}
			if(strlen($username)<3)
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! username is too short.
				</strong></div>";
				return $msg;
			}
			elseif (preg_match('/[^a-z0-9_-]+/i',$username)) {
				# code...
				$msg = "<div class='alert alert-danger'><strong>
				Error! username must only content alphanumerical,dahes and under.
				</strong></div>";
				return $msg;
			}


			if(filter_var($email,FILTER_VALIDATE_EMAIL) === false )
			{
				$msg = "<div class='alert alert-danger'><strong>
				Error! the email address is not valid.
				</strong></div>";
				return $msg;
			}

			

			$sql = "update tbl_user set Name=:name,Username=:username,Email=:email where id=:id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':name',$name);
			$query->bindValue(':username',$username);
			$query->bindValue(':email',$email);
			$query->bindValue(':id',$userid);
			$result = $query->execute();
			if($result)
			{
				$msg = "<div class='alert alert-success'><strong>
				Userdata updated successfully.
				</strong></div>";
				return $msg;
			}
			else
			{
				$msg = "<div class='alert alert-success'><strong>
				There has been problem updating data
				</strong></div>";
				return $msg;
			}
		}

		public function passUpdate($data,$userid)
		{
			$oldpass = $data['OldPass'];
			$newpass = $data['newpass'];
			$chekpass = $this->checkpassword($oldpass,$userid);
			if($chekpass == false )
			{
				$msg = "<div class='alert alert-danger'><strong>
				Old password is not exist
				</strong></div>";
				return $msg;
			}
			else
			if(strlen($newpass)<6)
			{
				$msg = "<div class='alert alert-danger'><strong>
				Passwor is so short.
				</strong></div>";
				return $msg;
			}
			else
			{
				$password = md5($newpass);
				$sql = "update tbl_user set Password=:pass where id=:id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':pass',$password);
			$query->bindValue(':id',$userid);
			$result = $query->execute();
			if($result)
			{
				$msg = "<div class='alert alert-success'><strong>
				Password updated successfully.
				</strong></div>";
				return $msg;
			}
			else
			{
				$msg = "<div class='alert alert-danger'><strong>
				There has been problem updating password
				</strong></div>";
				return $msg;
			}
			}
		}


		private function checkpassword($pass,$userid)
		{
			$oldpass = md5($pass);
			$sql = "select Password from tbl_user where Password = :pass AND id =:Id";
			$query = $this->db->pdo->prepare($sql);
			$query->bindValue(':pass',$oldpass);
			$query->bindValue(':Id',$userid);
			$query->execute();
			if($query->rowCount()>0)
			{
				return true;
			}
			else
			{
				return false;
			}
			

		}
	}
?>