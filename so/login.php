<!DOCTYPE html>
<html>
	<title>SO</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script src="./js/jquery.min.js"></script>

	<style>

	</style>
	
	<script type="text/javascript">

	</script> 
		
<body>

	<div class="row" style="margin:0px">
		<div class="col-4 bg-secondary text-white text-center">
			<div class="card-body my-5 py-5">
				<img src="./icons/cabinet_256.png" class="img-fluid" alt="...">
				<h2>Login to MariOS</h2>
				<p>The Cloud File Manager</p>
			</div>
		</div>
		<div class="col-8">
			<br/>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			  <li class="nav-item" role="presentation">
				<button class="nav-link active" id="loginform-tab" data-bs-toggle="tab" data-bs-target="#loginform" type="button" role="tab" aria-controls="loginform" aria-selected="true">Login</button>
			  </li>
			  <li class="nav-item" role="presentation">
				<button class="nav-link" id="registerform-tab" data-bs-toggle="tab" data-bs-target="#registerform" type="button" role="tab" aria-controls="registerform" aria-selected="false">Register</button>
			  </li>
			</ul>
			<div class="tab-content" id="myTabContent">
			  <div class="tab-pane fade show active" id="loginform" role="tabpanel" aria-labelledby="loginform-tab">
				<br/>
				<div class="row"><div class="col">
					<form action="" method="POST">
						<div class="form-group">
							<label for="input_email_2">Email address</label>
							<input type="text" class="form-control" name="input_email_2" placeholder="Enter email">
						</div>
						<br/>
						<div class="form-group">
							<label for="input_password_2">Password</label>
							<input type="password" class="form-control" name="input_password_2" placeholder="Password">
						</div>
						<br/>
						<input type="submit" value="Submit" class="btn btn-primary">
					</form>
				</div><div class="col"></div></div>
			  </div>
			  <div class="tab-pane fade" id="registerform" role="tabpanel" aria-labelledby="registerform-tab">
				<br/>
				<form action="" method="POST">
					<div class="row"><div class="col">
						<div class="form-group">
							<label for="input_fname">First Name</label>
							<input type="text" class="form-control" name="input_fname" placeholder="First name">
						</div>
					</div><div class="col">
						<div class="form-group">
							<label for="input_lname">Last Name</label>
							<input type="text" class="form-control" name="input_lname" placeholder="Last name">
						</div>
					</div></div>
					<br/>
					<div class="form-group">
						<label for="input_email_1">Email Address</label>
						<input type="text" class="form-control" name="input_email_1" placeholder="Enter email">
					</div>
					<br/>
					<div class="row"><div class="col">
						<div class="form-group">
							<label for="input_password_1">Password</label>
							<input type="password" class="form-control" name="input_password_1" aria-describedby="passwordHelp" placeholder="****">
						</div>
					</div><div class="col">
						<div class="form-group">
							<label for="input_conf_password">Confirm Password</label>
							<input type="password" class="form-control" name="input_conf_password" placeholder="****">
						</div>
					</div></div>
					<br/>
					<input type="submit" value="Submit" class="btn btn-primary">
				</form>
			  
			  </div>
			</div>
		
		</div>
	</div>

</body>
</html>