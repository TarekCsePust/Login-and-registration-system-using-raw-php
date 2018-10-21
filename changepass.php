   <?php 
  
   include 'include/header.php';
    include 'lib/classes/User.php';

   		Session::checksession();
   		
    ?>
    <?php 
    		if(isset($_GET['id']))
    		{
    			$userid = (int)$_GET['id'];
    			$sesid = Session::get("id");
    			if($sesid != $userid)
    			{
    				header("Location: index.php");
    			}
    		}

    		$user = new User();
    	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatepass']))
   		{
   			$passupdate = $user->passUpdate($_POST,$userid); 
   		}
    ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Change password <span class="pull-right"><a class="btn btn-primary" href="profile.php?id=<?php echo $userid ?>">Back</a></span></h2>
			</div>
			<div class="panel-body">
				<div style="max-width: 600px; margin:0 auto">
				<?php 

				   if(isset($passupdate))
					{
						echo $passupdate;
					}
				?>
				
				<form action="" method="post">
					<div class="form-group">
						<label for="oldPass">Old password</label>
						<input type="password" name="OldPass" id="name" class="form-control" required="" />
					</div>
					<div class="form-group">
						<label for="newpass">New Password</label>
						<input type="password" name="newpass" id="username" class="form-control" required="" />
					</div>
					<input type="submit" name="updatepass" class="btn btn-success" value="update"/>
					
				</form>
				
					
				</div>
			</div>
		</div>

<?php include 'include/footer.php'; ?>