<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='https://fonts.googleapis.com/css?family=Krona One' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/popper.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<title>Login</title>
	<style>
		.bg-login {
			background-color: #F8F8F8;
		}
		.logo {
			width: 140px;
			display: block;
			margin: 20px auto;
		}
		.login-form {
			width: 320px;
			height: 450px;
			background-color: #FFFFFF;
			box-shadow: 0px 0px 4px black;
			margin: 20px auto;
			border-radius: 20px;
		}
		.text1 {
			font-size: 24px;
			border-bottom: 3px solid tomato;
			width: 120px;
			text-align: center;
			margin: auto;
			padding-top: 34px;
		}
		.text2 {
			font-size: 18px;
			text-align: center;
			margin-top: 31px;
			padding: 14px;
			background-color: #beef00;

		}
		input {
			border: transparent;
			border-bottom: 2px solid tomato;
		}
		.form-group a {
			margin-left: 50px;
		}
		.input {
			text-align: center;
			margin-top: 42px;
		}
		.input2 {
			text-align: center;
			margin-top: 10px;
		}
		.input-icon {
			position: relative;
		}
		.input-icon i{
			position: absolute;
			top: 5px;
			left: 250px;
		}
		.form-check {
			margin-left: 29px;
		}
		input[placeholder], button {
			width: 220px;
		}
		/*global*/
		.font-krona {
			font-family: 'Krona One';
		}
	</style>
</head>
<body class="bg-login">
	<div class="container">
		<img class="logo" src="logo.png">
		<div class="login-form">
			<div class="text1 font-krona">Log In</div>
			<div class="text2 font-krona text-white shadow">Daftar Invenstaris</div>
			<form action="proses.php">
				<div class="form-group input">
					<input id="username" type="text" name="username" placeholder="Enter Username">
				</div>
				<div class="form-group input2 input-icon">
					<input class="" id="password" type="password" name="password" placeholder="Enter Password">
					<i class="fas fa-eye"></i>	
				</div>
				<div class="form-check">
					<input id="rememberMe" type="checkbox" name="rememberMe">
					<label for="rememberMe">Ingatkan Saya !</label>
				</div>
				<div class="form-group">
					<a href=""><small>Lupa Username/Password ?<small></a>
					</div>
					<div class="form-group input2">
						<button class="btn btn-outline-danger badge-pill">Masuk 
						<i class="fas fa-long-arrow-alt-right"></i></button>
					</div>
				</form>
			</div>
		</div>
	</body>
	</html>