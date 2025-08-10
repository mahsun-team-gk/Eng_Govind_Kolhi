<?php 
	
	class General{
// site_header
		public static function site_header(){
			?>
				<!DOCTYPE html>
						<html lang="en">
						<head>
						    <meta charset="UTF-8">
						    <meta name="viewport" content="width=device-width, initial-scale=1.0">
						    <title>Mind_Write</title>
						    <!-- Bootstrap 5 CSS -->
						    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
						        <style>
		html{
							scroll-behavior: smooth !important;
						}
					</style>
				</head>
				<body>

					<div class="container-fluid" id="home">
						<div class="row px-0">
							<div class="col-12 px-0">
								<h1 class="bg-info text-center py-2 mb-0">Header</h1>
							</div>
			
						</div>
<!--  site_header -->


<!-- site_footer -->
		<?php
		}
		public static function site_footer(){
			?>
	<!-- feedback -->

                <div class="container-fluid">
                    <div class="col-12 mt-2 bg-warning">
                        <div class="col-12 d-flex justify-content-center bg-warning">
                            <h2 class="fw-bold">Your Feedback</h2>
                        </div>

                <form class="row g-3">
                  <div class="col-md-4">
                    <label for="validationServer01" class="form-label">First name</label>
                    <input type="text" class="form-control is-valid" id="validationServer01" value="Mark" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="validationServer02" class="form-label">Last name</label>
                    <input type="text" class="form-control is-valid" id="validationServer02" value="Otto" required>
                    <div class="valid-feedback">
                      Looks good!
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="validationServerUsername" class="form-label">Username</label>
                    <div class="input-group has-validation">
                      <span class="input-group-text" id="inputGroupPrepend3">@</span>
                      <input type="text" class="form-control is-invalid" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>
                      <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        Please choose a username.
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="validationServer03" class="form-label">City</label>
                    <input type="text" class="form-control is-invalid" id="validationServer03" aria-describedby="validationServer03Feedback" required>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                      Please provide a valid city.
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="validationServer04" class="form-label">State</label>
                    <select class="form-select is-invalid" id="validationServer04" aria-describedby="validationServer04Feedback" required>
                      <option selected disabled value="">Choose...</option>
                      <option>...</option>
                    </select>
                    <div id="validationServer04Feedback" class="invalid-feedback">
                      Please select a valid state.
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label for="validationServer05" class="form-label">Zip</label>
                    <input type="text" class="form-control is-invalid" id="validationServer05" aria-describedby="validationServer05Feedback" required>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                      Please provide a valid zip.
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3" aria-describedby="invalidCheck3Feedback" required>
                      <label class="form-check-label" for="invalidCheck3">
                        Agree to terms and conditions
                      </label>
                      <div id="invalidCheck3Feedback" class="invalid-feedback">
                        You must agree before submitting.
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                  </div>
                </form>
	<!-- Footer -->
    <footer class="bg-dark text-white py-2">
        <div class="container-fluid bg-warning">
            <div class="row">
                <div class="col-md-4 mb-4 mt-4 ">
                    <h5 class="fw-bold">Social Media</h5>
                    <div class="social-icons">
                        <a href="#" class="text-white me-3">facebook<i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3">Twiteer<i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3">Instagram<i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white">Linked In<i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mt-4">
                    <h6 class="fw-bold">Header</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Home</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">About</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Contact Us</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none">Posts</a></li>
                    </ul>
                </div>
	<!-- Footer -->



	<!-- feedback -->
                <div class="col-md-4 mb-7 mt-4">
                    <h6 class="fw-bold">Subscribe to Newsletter</h6>
                    <p class="fw-bold">Join Our Community </p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Your email">
                        <button class="btn btn-primary" type="button">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Mind_Write. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
<!-- site_footer -->

    	<?php
		}

	public static function footer_scripts(){
			?>
					<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
				</body>
				</html>
			<?php
		}

		public static function site_navbar(){
			?>
<!-- Navigation -->
				<div class="row sticky-top">
					<div class="col-12 bg-primary-subtle">
						<nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="col-12 mb-1 mt-2">
            <nav class="navbar navbar-expand-lg navbar-warning bg-warning shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="#"> <img src="1.png" class="rounded-circle" alt="Description" width="90" height="70"></a>
                    <a class="navbar-brand fw-bold" href="#">Mind Write</a> 

                    <!-- <i class="fas fa-pen-fancy me-2"></i> -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav" >
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active fw-bold" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="#">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="#">Contact US</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold" href="#">Posts</a>
                            </li>
                        </ul>
                                <div class="auth-buttons ">
                            <div class="d-flex mx-2">    
                            <button class="btn btn-outline-primary mx-2 fw-bold text-end" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                            <button class="btn btn-outline-primary mx-2 fw-bold" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                                       </div>
                                   </div>
                              </div>
                        </nav>
<!-- NAVIGATION -->

			<?php
		}
		public static function login_modal(){
			?>
<!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel" >Login</h5>
                        <button type="button " class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="loginEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="loginPassword" required>
                            </div>

                            <!-- remember -->
                                    <div class="mb-3">
                                      <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                        <label class="form-check-label" for="dropdownCheck">
                                          Remember me
                                        </label>
                                              </div>
                                            </div>
                                            <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->
                                          </form>
                                          <div class="dropdown-divider"></div>
                                          <a class="dropdown-item" href="registerModalLabel">New around here? Sign up</a>
                                          <a class="dropdown-item" href="loginModalLabel">Forgot password?</a>
                                          <div class="spinner-border text-warning" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                                </div>
                            <!-- remember -->
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- Login Modal -->
			<?php
		}
		public static function register_modal(){
			?>
<!-- Register Modal -->

        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Register</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="registerName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="registerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="registerName" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="registerEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="registerPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="registerConfirmPassword" required>
                            </div>
                            
                            <div class="mb-3">
                              <label for="dob" class="form-label">Date of Birth</label>
                              <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Gender</label>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                <label class="form-check-label" for="male">Male</label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                <label class="form-check-label" for="female">Female</label>
                              </div>
                              <div class="mb-3">
                                <label for="registerConfirmPassword" class="form-label">Address</label>
                                <input type="password" class="form-control" id="registerConfirmPassword" required>
                            </div>

                            <!-- role  -->
                                    <div class="form-group">
                                      <label for="userRole">Role</label>
                                      <select class="form-control" id="userRole">
                                        <option>Admin</option>
                                        <option>User</option>
                                      </select>
                                    </div>
                            <!-- role  -->

                              <div class="mb-3">
                                  <label for="formFile" class="form-label">Upload Profile Picture</label>
                                  <input class="form-control" type="file" id="formFile" accept="image/*">
                                  <div class="form-text">Accepted formats: JPG, PNG (Max 2MB)</div>
                                </div>
                                
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<!-- Register Modal -->
	<?php
		}

		public static function site_section(){
			?>
<!--  Section -->
                <section class="hover-section">
                <div class="container-fluid ">
                <div class="col-12 bg-warning mt-1 rounded py-5">  
                <section class="section">
                    <div class="container text-center">
                        <h1 class="display-4 fw-bold mb-4">Share Your Ideas Around The World!</h1>
                        <p class="lead mb-5 display-6 fw-bold ">Your mind is a garden, what you plant grows.</p>
                        <div class="md-2">
                        <a href="#" class="btn btn-outline-light btn-lg px-4">Thought</a>
                        <a href="#" class="btn btn-outline-primary btn-lg px-4">Write</a>
                        <a href="#" class="btn btn-outline-light btn-lg px-4">Explore</a> <br>
                    </div>
                  </div>  
                    </div>

                </section>
<!-- Section -->

			<?php
		}

		public static function team_card($image,$name,$info){
			?>
				<div class="card border-0 shadow-lg">
				  <img src="image/<?=$image?>" class="card-img-top" alt="Member1">
				  <div class="card-body">
				    <h5 class="card-title"><?=$name?></h5>
				    <p class="card-text"><?=$info?></p>
				  </div>
				</div>
			<?php
		}
	}
?>

