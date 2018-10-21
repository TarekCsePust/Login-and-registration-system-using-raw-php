   <?php include 'include/header.php'; 
   		 include 'lib/classes/User.php';
   ?>
   <?php
   		$user = new User();
   		if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register']))
   		{
   			$userReg = $user->userRegistration($_POST); 
   		}
   ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>User Registration</h2>
			</div>
			<div class="panel-body">
			   <?php 

					if(isset($userReg))
					{
						echo $userReg;
					}
				?>
				<div style="max-width: 600px; margin:0 auto">
				
				<form action="" method="POST">
					<div class="form-group">
						<label for="name">Your Name</label>
						<input type="text" name="name" id="name" class="form-control" required="" />
					</div>
					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" required=""/>
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="text" name="email" id="email" class="form-control" value="" required=""/>
					</div>
					<div class="form-group">
						<label for="pass">Password</label>
						<input type="password" name="pass" id="pass" class="form-control" value="" required=""/>
					</div>
					<button type="submit" name="register" class="btn btn-primary">
						Submit
					</button>
				</form>
					
				</div>
			</div>
		</div>

<?php include 'include/footer.php'; ?>