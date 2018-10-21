<!DOCTYPE html>

<?php 
   include '/../lib/classes/Session.php';
   Session::init();
?>
<html>
<head>
	<title>Login and register page</title>
	<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php 
   if(isset($_GET['action']) && $_GET['action']==logout)
   {
   	  Session::destroy();
   	  //setcookie("login","1",time()-120);
   }
?>
<body>
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Login and Regester System.</a>
				</div>
				<ul class="nav navbar-nav pull-right">
					<?php 
					$id = Session::get("id");
					   $userlogin = Session::get("login");
					   if($userlogin)
					   { 
					   	?>
                      <li><a href="index.php">Home</a></li>
					 <li><a href="profile.php?id=<?php echo $id ?>">Profile</a></li>
					 <li><a href="?action=logout">Logout</a></li>
					
					<?php  }else { ?>
					
					<li><a href="register.php">Register</a></li>
					<li><a href="login.php">Login</a></li>
					<?php } ?>
					
				</ul>
			</div>
		</nav>
