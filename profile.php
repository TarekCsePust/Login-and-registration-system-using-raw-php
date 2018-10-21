   <?php 
  
   include 'include/header.php';
    include 'lib/classes/User.php';

   		Session::checksession();
   		
    ?>
    <?php 
    		if(isset($_GET['id']))
    		{
    			$userid = (int)$_GET['id'];
    		}

    		$user = new User();
    	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update']))
   		{
   			$userupdate = $user->userUpdate($_POST,$userid); 
   		}
    ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>User Profile <span class="pull-right"><a class="btn btn-primary" href="index.php">Back</a></span></h2>
			</div>
			<div class="panel-body">
				<div style="max-width: 600px; margin:0 auto">
				<?php 

				   if(isset($userupdate))
					{
						echo $userupdate;
					}
				?>
				<?php

					$userdata = $user->getUserById($userid);
					if($userdata)
					{
				?>
				<form action="" method="post">
					<div class="form-group">
						<label for="name">Your Name</label>
						<input type="text" name="name" id="name" class="form-control" value="<?php echo $userdata->Name ?>"/>
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" value="<?php echo $userdata->Username ?>" />
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="text" name="email" id="email" class="form-control" value="<?php
						echo $userdata->Email ?>"/>
					</div>
					<?php
					  $sesid = Session::get("id");
					  if($sesid == $userid)
					  { 
					?>
					<input type="submit" name="update" class="btn btn-success" value="update"/>
					<a class="btn btn-primary" href="changepass.php?id=<?php echo $userid ?>">Password change</a>
					<?php } ?>
				</form>
				<?php } ?>
					
				</div>
			</div>
		</div>

<?php include 'include/footer.php'; ?>