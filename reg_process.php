			
<!-- reg proces start -->
			<?php
			session_start();
			require_once("require/database_connection.php");


			use PHPMailer\PHPMailer\PHPMailer;
			use PHPMailer\PHPMailer\SMTP;
			use PHPMailer\PHPMailer\Exception;

			require 'PHPMailer/src/PHPMailer.php';
			require 'PHPMailer/src/SMTP.php';
			require 'PHPMailer/src/Exception.php';


			/*echo "<pre>";
			print_r($_POST);
			echo "</pre>";
			echo "<pre>";
			print_r($_FILES);
			echo "</pre>";*/



			$first_name = $last_name = $email = $password = $message = $subject=  $date_of_birth = $address = $gender = $profile_pic = '';
			$first_name_msg = $last_name_msg = $email_msg = $password_msg = $date_of_birth_msg = $address_msg = $gender_msg = $profile_pic_msg = '';
			



			if (isset($_POST['submit'])) {
			    // Get POST data safely (don't use extract)
			    $first_name 	= $_POST['first_name'] ?? '';
			    $last_name 		= $_POST['last_name'] ?? '';
			    $email 			= $_POST['email'] ?? '';
			    $subject 		= $_POST['email'] ?? '';
			    $message 		= $_POST['email'] ?? '';
			    $password 		= $_POST['password'] ?? '';
			    $date_of_birth 	= $_POST['date_of_birth'] ?? '';
			    $address 		= $_POST['address'] ?? '';
			    $gender 		= $_POST['gender'] ?? '';




			    /*---------------------Pattern Definitions---------------------------*/

			    $alpha_pattern = '/^[A-Z]{1}[a-z]{2,}$/';
			    $email_pattern = '/^[a-z]+\d*[@]{1}[a-z]+[.]{1}(com|net|org){1}$/';
			    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
			    $date_of_birth_pattern = '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/';

			    $flag = true;



try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'phpbasic2k25@gmail.com';
        $mail->Password = 'sffymqljdnupfzjc';
        
        
        $mail->setFrom($email, $first_name);
        $mail->addAddress('phpbasic2k25@gmail.com', 'Govind Kolhi');
        $mail->addReplyTo($email, $first_name);
        
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        
        if(isset($_FILES['file'])){

            for($i = 0 ; $i < count ($_FILES['file']['name']); $i++) {

                $tmp_name = $_FILES['file']['tmp_name'][$i];

                $name = $_FILES['file']['name'][$i];

                $mail->addAttachment($tmp_name, $name);
            }
        }
        
        $mail->send();
        echo "<h1>"."Message has been sent:"."</h1>";
        echo "<hr/>";
        echo "<br/>";
        echo "<hr/>";
        echo "<br/>";
    } catch (Exception $e) {
        echo "<h1>"."Message could not be sent. Mailer Error:"."</h1>";
    }
} else {
    echo ".";
}
			    
			    
			    /*-------First Name Validation---------------*/
			    if (empty($first_name)) {
			        $flag = false;
			        $first_name_msg = "Required Field";
			    } elseif (!preg_match($alpha_pattern, $first_name)) {
			        $flag = false;
			        $first_name_msg = "Pattern Must Be Like eg: Ahmed";
			    }

			    /*-------Last Name Validation---------------*/
			    if (empty($last_name)) {
			        $flag = false;
			        $last_name_msg = "Required Field";
			    } elseif (!preg_match($alpha_pattern, $last_name)) {
			        $flag = false;
			        $last_name_msg = "Pattern Must Be Like eg: Khan";
			    }

			    /*-------Email Validation---------------*/
			    if (empty($email)) {
			        $flag = false;
			        $email_msg = "Required Field";
			    } elseif (!preg_match($email_pattern, $email)) {
			        $flag = false;
			        $email_msg = "Pattern Must Be Like eg: ahmed123@gmail.com | ahmed@gmail.com";
			    } else {
			        // Check if email exists in database
			        $email_check_query = "SELECT * FROM user WHERE email = ?";
			        $stmt_check = mysqli_prepare($connection, $email_check_query);
			        mysqli_stmt_bind_param($stmt_check, "s", $email);
			        mysqli_stmt_execute($stmt_check);
			        $result = mysqli_stmt_get_result($stmt_check);
			        
			        if(mysqli_num_rows($result) > 0) {
			            $flag = false;
			            $email_msg = "Email already exists. Please login.";
			        }
			    }

			    /*-------Password Validation---------------*/
			    if (empty($password)) {
			        $flag = false;
			        $password_msg = "Required Field";
			    } elseif (!preg_match($password_pattern, $password)) {
			        $flag = false;
			        $password_msg = "Must contain at least 8 characters with 1 uppercase, 1 lowercase, 1 number, and 1 special character";
			    }

			    /*-------Date of Birth Validation---------------*/
			    if (empty($date_of_birth)) {
			        $flag = false;
			        $date_of_birth_msg = "Required Field";
			    } elseif (!preg_match($date_of_birth_pattern, $date_of_birth)) {
			        $flag = false;
			        $date_of_birth_msg = "Invalid date format. Please use YYYY-MM-DD format.";
			    } else {
			        $date_parts = explode('-', $date_of_birth);
			        if (!checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
			            $flag = false;
			            $date_of_birth_msg = "Invalid date (e.g., February 30 doesn't exist).";
			        } elseif (new DateTime($date_of_birth) >= new DateTime()) {
			            $flag = false;
			            $date_of_birth_msg = "Date of birth must be in the past.";
			        }
			    }

			    /*-------Address Validation---------------*/
			    if (empty($address)) {
			        $flag = false;
			        $address_msg = "Required Field";
			    }

			    /*-------Gender Validation---------------*/
			    if (empty($gender)) {
			        $flag = false;
			        $gender_msg = "Field Required";
			    }

			    /*-------Profile Picture Validation---------------*/
			    $allowed_extensions = ['jpg', 'jpeg', 'png'];
			    $max_size = 5 * 1024 * 1024; // 5MB
			    $targetFile = '';

			    if (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] === UPLOAD_ERR_NO_FILE) {
			        $flag = false;
			        $profile_pic_msg = "Profile picture is required.";
			    } else {
			        $file = $_FILES['profile_pic'];
			        
			        if ($file['error'] !== UPLOAD_ERR_OK) {
			            $flag = false;
			            $profile_pic_msg = "File upload error: " . $file['error'];
			        } else {
			            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			            
			            if (!in_array($file_ext, $allowed_extensions)) {
			                $flag = false;
			                $profile_pic_msg = "Only JPG, JPEG, PNG files are allowed.";
			            } elseif ($file['size'] > $max_size) {
			                $flag = false;
			                $profile_pic_msg = "File size must be less than 5MB.";
			            } elseif (!getimagesize($file['tmp_name'])) {
			                $flag = false;
			                $profile_pic_msg = "Uploaded file is not a valid image.";
			            }
			            
			            // Prepare for file move if validation passes
			            if ($flag) {
			                $upload_dir = "uploads/";
			                if (!is_dir($upload_dir)) {
			                    mkdir($upload_dir, 0755, true);
			                }
			                $new_filename = uniqid() . '_' . basename($file['name']);
			                $targetFile = $upload_dir . $new_filename;
			            }
			        }
			    }

			    /*-------Final Submission Check---------------*/
			    if ($flag) {
			        // Move uploaded file if all validations passed
			        if (!move_uploaded_file($file['tmp_name'], $targetFile)) {
			            $_SESSION['message'] = "Failed to save uploaded file.";
			            $_SESSION['color'] = "red";
			            header("Location: form.php");
			            exit();
			        }

			        // Hash password
			        $hashed_password = ($password);

			        // Insert new user
			        $query = "INSERT INTO user (first_name, last_name, email, password, date_of_birth, address, gender, user_image) 
			                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			        
			        $statement = mysqli_prepare($connection, $query);
			        mysqli_stmt_bind_param(
			            $statement, 
			            "ssssssss",
			            $first_name, 
			            $last_name, 
			            $email, 
			            $hashed_password,
			            $date_of_birth, 
			            $address,
			            $gender,
			            $targetFile
			        );

			        if (mysqli_stmt_execute($statement)) {
			            $_SESSION['message'] = "Registration successful! Please login.";
			            $_SESSION['color'] = "lightgreen";
			            header("Location: login.php");
			            exit();

			        } else {
			            $_SESSION['message'] = "Registration failed: " . mysqli_error($connection);
			            $_SESSION['color'] = "red";
			        }
			        
			        mysqli_stmt_close($statement);
			    }
			

			// Close connection (at the end of the file)
			mysqli_close($connection);
			?>
<!-- reg proces start -->
