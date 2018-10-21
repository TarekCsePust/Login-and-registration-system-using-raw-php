   <?php 
   		  
   		  include 'include/header.php'; 
   		  include 'lib/classes/User.php';
   		 Session::checksession();
   		 $user = new User();		 
   ?>
   <?php

   		$loginmsg = Session::get("loginmsg");
   		 if(isset($loginmsg))
   		 {
   		 	echo $loginmsg;
   		 }
   		 Session::set("loginmsg",NULL);

   ?>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>User List<span class="pull-right">Welcome <strong>
					<?php
						$name = Session::get("name");
						if(isset($name))
						{
							echo $name;
						}
					?>
				</strong></span></h2>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<th width="20%">Serial</th>
					<th width="20%">Name</th>
					<th width="20%">Username</th>
					<th width="20%">Email</th>
					<th width="20%">Action</th>
				<?php
					$user = new User();
					$userdata = $user->getUserdata();
					if($userdata)
					{ 
						$i = 0;
						foreach($userdata as $Sdata)
						{

						$i++;
				?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $Sdata->Name; ?> </td>
					<td><?php echo $Sdata->Username; ?></td>
					<td><?php echo $Sdata->Email; ?></td>
						<td><a class="btn btn-primary" href="profile.php?id=<?php echo $Sdata->id; ?>">view</a></td>
					</tr>

				
					



					<?php }} else{?>
					<tr><td colspan="5"><h2>No user data found</h2></td></tr>
					<?php } ?>
				</table>
			</div>
		</div>

<?php include 'include/footer.php'; ?>