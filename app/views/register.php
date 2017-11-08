<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title><?= $data['title']; ?></title>

	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="favicon.png" type="image/x-icon">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="app/views/css/login.css">
	<link rel="stylesheet" type="text/css" href="app/views/css/main.css">


</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<a class="navbar-brand" href="index.php">
				<img src="favicon.png" width="30" height="30" class="d-inline-block align-top" alt="">
				Dice Game
			</a>
			<?php if(!isset($data['guest'])) {?>
			<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
				<li class="nav-item <?php echo (isset($home_page) ? 'active' : ''); ?>">
					<a class="nav-link" href="index.php">Home</a>
				</li>
				<li class="nav-item <?php echo (isset($stats_page) ? 'active' : ''); ?>">
					<a class="nav-link" href="stats.php">Stats</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<p class="text-success nav-link mb-0 font-weight-bold">Welcome, <span id="username">
					<?php echo strtoupper($_SESSION['username']); ?></span></p>
				<a class="btn btn-outline-success my-2 my-sm-0" href="logout.php">Logout</a>
			</form>
			<?php } ?>
		</div>
	</nav>
	<?php
	if(isset($_POST['username']) && $_POST['username'] != "" && $_POST['password'] != "" && $_POST['repeatPassword'] != "") {

	try {
		$username = $_POST['username'];
		$user = $this->model('User');
		$response = $user->getUserByUsername($username);

		if(empty($response)) {
			if ($_POST['password'] == $_POST['repeatPassword']) {

				$user->addUser($_POST['username'], $_POST['password'], $_POST['first_name'], $_POST['last_name'], $_POST['birthdate'], 
					$_POST['mobile_no'], $_POST['phone_no'], $_POST['email'], $_POST['company'], $_POST['branch']);

				$password = password_hash($_POST["password"], PASSWORD_DEFAULT); 

				$_SESSION['username'] = $_POST['username'];
				$_SESSION['password'] = $password;

				$response['message'] = ['type' => 'success','body' => 'User was added'];
				$conn = null;
				// header("Location: login.php");
			} else {
				$response['message'] = ['type' => 'danger', 'body' => 'Passwords don\'t match.'];
				$conn = null;
			}

		} else {
			$response['message'] = ['type' => 'danger', 'body' => 'This username is already registered. Choose another.'];
			$conn = null;
		}

	} catch(PDOException $e) {
		$response['message'] = ['type' => 'danger','body' => $e->getMessage()];
	}
} else {
	$response['message'] = ['type' => 'warning','body' => 'No user data to submit'];
} 

?>
	<div class="container">
		<form class="form-signin" method="POST">
			<?php if(isset($response['message']) && $response['message']['type'] != 'warning'){ ?>
			<div class="alert alert-danger my-5" role="alert">
				<?php echo $response['message']['body']; ?>
			</div>
			<?php } ?>

			<h2 class="form-signin-heading">Please register</h2>

			<label for="username" class="sr-only">Username</label>
			<input type="text" id="username" name="username" class="form-control" placeholder="Enter username">

			<label for="password" class="sr-only">Password</label>
			<input type="password" id="password" class="form-control" name="password" placeholder="Password">      

			<label for="repeatPassword" class="sr-only">Repeat password</label>
			<input type="password" id="repeatPassword" class="form-control" name="repeatPassword" placeholder="Repeat a password">

			<label for="first_name" class="sr-only">First name</label>
			<input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name">
			
			<label for="last_name" class="sr-only">Last name</label>
			<input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name">
			
			<label for="birthdate" class="sr-only">Birthdate</label>
			<input type="text" id="birthdate" name="birthdate" class="form-control" placeholder="Enter date of birth">

			<label for="mobile_no" class="sr-only">Mobile number</label>
			<input type="text" id="mobile_no" name="mobile_no" class="form-control" placeholder="Enter mobile number">

			<label for="phone_no" class="sr-only">Phone number</label>
			<input type="text" id="phone_no" name="phone_no" class="form-control" placeholder="Enter phone number">

			<label for="email" class="sr-only">Email</label>
			<input type="text" id="email" name="email" class="form-control" placeholder="Enter email">			

			<label for="company" class="sr-only">Company</label>
			<input type="text" id="company" name="company" class="form-control" placeholder="Enter company">			

			<label for="branch" class="sr-only">Branch</label>
			<input type="text" id="branch" name="branch" class="form-control" placeholder="Enter branch">
			
			<input type="submit" name="register" value="Register" class="btn btn-lg btn-success btn-block">
			<a class="btn btn-lg btn-primary btn-block" href="login.php">Back to login</a>

		</form>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>