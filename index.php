<?php 
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/fontawesome-5.13.1/css/all.min.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
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
			width: 310px;
			height: 450px;
			background-color: #FFFFFF;
			box-shadow: 0px 0px 4px black;
			margin: 20px auto;
			border-radius: 20px;
		}
		.login {
			font-size: 28px;
			border-bottom: 3px solid tomato;
			width: 120px;
			text-align: center;
			margin: auto;
			padding-top: 34px;
		}
		.judul {
			font-size: 21px;
			text-align: center;
			margin-top: 31px;
			padding: 14px;
			background-color: #beef00;
		}
		input {
			border: transparent;
			border-bottom: 1px solid tomato;
		}
		.form-group a {
			margin-left: 50px;
		}
		.input {
			text-align: center;
			margin-top: 28px;
		}
		.input2 {
			text-align: center;
			margin-top: 20px;
		}
		.input-icon {
			position: relative;
		}
		.input-icon i{
			position: absolute;
			top: 5px;
			left: 242px;
		}
		.form-check {
			margin-left: 29px;
		}
		.c-pointer {
			cursor: pointer;
		}
		.pesanError {
			text-align: center;
			background-color: tomato;
			width: 100%;
			height: 25px;
			color: #ffffff;
		}
		input[placeholder], button {
			width: 220px;
		}
		/*global*/
		.font-neue { font-family: 'Bebas Neue'; }
	</style>
</head>
<body class="bg-login">
	<div class="container">
		<img class="logo" src="logo.png">
		<div class="login-form">
			<div class="login font-neue">Login</div>
			<div class="shadow">
				<div class="judul font-neue text-white">Daftar Invenstaris</div>
				<div id="pesanError"></div>
			</div>
			<form action="home.php" method="post">
				<div class="form-group input">
					<input id="username" type="text" name="username" placeholder="Enter Username" autocomplete="off">
				</div>
				<div class="form-group input2 input-icon">
					<input id="password" type="password" name="password" placeholder="Enter Password" autocomplete="off">
					<i id="hideShowPassword" class="fas fa-eye c-pointer"></i>	
				</div>
				<div class="form-check">
					<input id="rememberMe" type="checkbox" name="rememberMe">
					<label for="rememberMe">Ingatkan Saya !</label>
				</div>
				<div class="form-group">
					<a href=""><small>Lupa Username/Password ?</small></a>
				</div>
				<div class="form-group input2">
					<button class="btn btn-danger badge-pill">Masuk 
						<i class="fas fa-long-arrow-alt-right"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
	<script>
		"use strict";

		$(document).ready(function() {
			$("button").click(function(e) {
				$("#pesanError").addClass("pesanError");
				let pesan 			= "";
				let valUsername 	= $("#username").val().trim();
				let valPassword 	= $("#password").val().trim();

				if (!valUsername || !valPassword ) {
					pesan += "<small>Username/Password tidak boleh kosong*</small>";
					$("#username").css({"border" : "1px solid tomato"});
					$("#password").css({"border" : "1px solid tomato"});
				}
				else {
					e.preventDefault();
					$.post("files_backend_ajax/backend_login.php",{
						halaman_login 	: true,
						username 		: valUsername,
						password 		: valPassword 
					},function(text, status, xhr) {
						$("#pesanError").html(text);
						if (text != "<small>Username/Password tidak sesuai*</small>") {
							$("form").submit();
						}
					});
				}

				if (pesan !== "") {
					$("#pesanError").html(pesan);
					e.preventDefault();
				}
			}); 

			$("#hideShowPassword").hide();
			$("#username").focus(function() {
				$(this).css({"border" : "transparent","border" : "1px solid lightgreen"});
			});
			$("#username").blur(function() {
				$(this).css({"border" : "transparent","border-bottom" : "1px solid tomato"});
			});

			$("#password").focus(function() {
				$(this).css({"border" : "transparent","border" : "1px solid lightgreen"});
				$("#hideShowPassword").fadeIn(150);
			});

			$("#password").blur(function() {
				$(this).css({"border" : "transparent","border-bottom" : "1px solid tomato"});
				$("#hideShowPassword").fadeOut(150);		
			});

			$("#hideShowPassword").click(function(e) {
				$("#password").focus();
				if ( $("#password").attr("type") === "password" ) {
					$("#password").attr("type","text");
					$("#hideShowPassword").addClass("fas fa-eye-slash");
				}
				else if ( $("#password").attr("type") === "text" ) {
					$("#password").attr("type","password");
					$("#hideShowPassword").removeClass("fa-eye-slash");
				}
			});
		});		
	</script>
</body>
</html>