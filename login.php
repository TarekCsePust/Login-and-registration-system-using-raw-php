    <?php include 'include/header.php'; 
   		 include 'lib/classes/User.php';
   		 include 'lib/classes/token.php';
   		   Session::checklogin();

   ?>
   <?php
   		$user = new User();
   		if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login']))
   		{
   			//Token::getToken();
   			//Token::checktoken($_POST['token']);
   			$userLogin = $user->userLogin($_POST); 
   		}
   ?>


		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>User Login</h2>
			</div>
			<div class="panel-body">
				<div style="max-width: 600px; margin:0 auto">
				<?php
					if(isset($userLogin))
				      {
				      	echo $userLogin;
				      }
				 ?>
				<form action="" method="post">
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="text" name="email" id="email" class="form-control clr" placeholder="Email Address" required="" />
					</div>
					<div class="form-group">
						<label for="pass">Password</label>
						<input type="password" name="pass" id="pass" class="form-control" placeholder="Password" required="" />
					</div>
					<input type="checkbox" name="remember" value="1"><strong> Keep me login</strong><br>
					<?php// echo Token::getTokenfield(); ?>
					<input type="submit" name="login" class="btn btn-success" value="Login"/>
				</form>
					
				</div>
			</div>
		</div>

<?php include 'include/footer.php'; ?>