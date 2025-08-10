<!-- login form start		 -->
		<?php
	session_start();


	 


	require_once("General.php");
	require_once("require/database_connection.php");

	// Display header and navbar
	General::site_header();
	General::site_navbar();
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Login System</title>
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- login css	     -->
		    <style>
		        body {
		            background-color: #f8f9fa;
		            display: flex;
		            flex-direction: column;
		            min-height: 100vh;
		        }
		        .login-container {
		            max-width: 400px;
		            margin: auto;
		            padding: 2rem;
		            background: white;
		            border-radius: 10px;
		            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
		            margin-top: 5rem;
		        }
		        .login-header {
		            color: #0d6efd;
		            text-align: center;
		            margin-bottom: 2rem;
		            font-weight: 600;
		        }
		        .form-control:focus {
		            border-color: #0d6efd;
		            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
		        }
		        .btn-primary {
		            background-color: #0d6efd;
		            border: none;
		            padding: 0.5rem 1rem;
		        }
		        .btn-primary:hover {
		            background-color: #0b5ed7;
		        }
		        .register-link {
		            color: #0d6efd;
		            text-decoration: none;
		        }
		        .register-link:hover {
		            text-decoration: underline;
		        }
		        .error-message {
		            color: #dc3545;
		            text-align: center;
		            margin-bottom: 1rem;
		        }
		    </style>
	<!-- login css	     -->
			
			<?php
			if (isset($_SESSION['message'])) {
		    $color = $_SESSION['color'] ?? 'lightblue';
		    echo "<div style='padding:10px; background-color: $color; color: black; margin-bottom: 15px; border-radius: 5px; text-align:center;'>
		            " . htmlspecialchars($_SESSION['message']) . "
		          </div>";
		    unset($_SESSION['message']);
		    unset($_SESSION['color']);
			}
			?>

		<?php if (isset($_GET['error'])): ?>
    <div style="color: red; margin-bottom: 15px;">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
		<?php endif; ?>

	</head>
	<body>
	    <div class="container">
	        <div class="login-container">
	            <h2 class="login-header">Login to Your Account</h2>
	            
	            
	            
	            <form method="POST" action="login_new_process.php">
	                <div class="mb-3">
	                    <label for="email" class="form-label">Email address</label>
	                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
	                </div>

	                <div class="mb-3">
	                    <label for="password" class="form-label">Password</label>
	                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
	                </div>
	                <div class="d-grid gap-2">
	                    <button type="submit" name="login" class="btn btn-primary">Login</button>
	                </div>

					<div class="d-grid gap-2 mt-3">
                        <a href="forgot_password.php" type="password" name="new_password" class="btn btn-primary">Forgot Password</a>
	                </div>

	                <div class="text-center mt-3">
	                    <span>Don't have an account? </span>
	                    <a href="form.php" class="register-link">Register here</a>
	                </div>
	            </form>
	        </div>
	    </div>

	    <?php
	    General::site_footer();
	    General::footer_scripts();
	    ?>
	</body>
	</html>
<!-- // Login processing -->
	                
