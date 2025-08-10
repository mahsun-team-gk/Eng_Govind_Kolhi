	<?php
	if (isset($_POST['submit'])) {
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
    extract($_POST);

    $flag = true;

    /*---------------------Pattern---------------------------*/
    $alpha_pattern = '/^[A-Z]{1}[a-z]{2,}$/';
    $email_pattern = '/^[a-z]+\d*[@]{1}[a-z]+[.]{1}(com|net|org){1}$/'; //example123@gmail.com
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    $date_of_birth_pattern = '/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/';

    /*-------Variables Error messages---------------*/
    $first_name_msg = null;
    $last_name_msg = null;
    $email_msg = null;
    $password_msg = null;
    $date_of_birth_msg = null;
    $gender_msg = null;
    $profile_pic_msg = null;
    $address_msg = null;

    /*-------First Name Validation---------------*/
    if ($first_name === "") {
        $flag = false;
        $first_name_msg = "Required Field";
    } else {
        if (!(preg_match($alpha_pattern, $first_name))) {
            $flag = false;
            $first_name_msg = "Pattern Must Be Like eg: Ahmed";
        } else {
            $first_name_msg = "";
        }
    }

    /*-------Last Name Validation---------------*/
    if ($last_name === "") {
        $flag = false;
        $last_name_msg = "Required Field";
    } else {
        if (!(preg_match($alpha_pattern, $last_name))) {
            $flag = false;
            $last_name_msg = "Pattern Must Be Like eg: Khan";
        } else {
            $last_name_msg = "";
        }
    }

    /*-------Email Validation---------------*/
    if ($email === "") {
        $flag = false;
        $email_msg = "Required Field";
    } else {
        if (!(preg_match($email_pattern, $email))) {
            $flag = false;
            $email_msg = "Pattern Must Be Like eg: ahmed123@gmail.com | ahmed@gmail.com";
        } else {
            $email_msg = "";
        }
    }

    /*-------Date of Birth Validation---------------*/
    /*-------Date of Birth Validation---------------*/
if ($date_of_birth === "") {
    $flag = false;
    $date_of_birth_msg = "Required Field";
} else {
    // First validate the format
    if (!preg_match($date_of_birth_pattern, $date_of_birth)) {
        $flag = false;
        $date_of_birth_msg = "Invalid date format. Please use YYYY-MM-DD format.";
    } else {
        // Split the date into components
        $date_parts = explode('-', $date_of_birth);
        $year = $date_parts[0];
        $month = $date_parts[1];
        $day = $date_parts[2];
        
        // Check if the date is valid
        if (!checkdate($month, $day, $year)) {
            $flag = false;
            $date_of_birth_msg = "Invalid date (e.g., February 30 doesn't exist).";
        } 
        // Check if date is in the past
        else {
            $input_date = new DateTime($date_of_birth);
            $today = new DateTime();
            
            if ($input_date >= $today) {
                $flag = false;
                $date_of_birth_msg = "Date of birth must be in the past.";
            } else {
                $date_of_birth_msg = "";
            }
        }
    }
}
    /*-------Password Validation---------------*/
    if ($password === "") {
        $flag = false;
        $password_msg = "Required Field";
    } else {
        if (!(preg_match($password_pattern, $password))) {
            $flag = false;
            $password_msg = "Must contain at least 8 characters with 1 uppercase, 1 lowercase, 1 number, and 1 special character";
        } else {
            $password_msg = "";
        }
    }

    /*-------Address Validation---------------*/
    if ($address === "") {
        $flag = false;
        $address_msg = "Required Field";
    } else {
        $address_msg = "";
    }

    /*-------Gender Validation---------------*/
    if (!isset($gender)) {
        $flag = false;
        $gender_msg = "Field Required";
    } else {
        $gender_msg = "";
    }

    /*-------Profile Picture Validation---------------*/
    $profile_pic_msg = "";
    $allowed_extensions = ['jpg', 'jpeg', 'png'];
    $max_size = 5 * 1024 * 1024; // 5MB

    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] !== UPLOAD_ERR_NO_FILE) {
        $file = $_FILES['profile_pic'];
        
        // Check for upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $flag = false;
            $profile_pic_msg = "File upload error: " . $file['error'];
        } else {
            // Check file extension
            $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($file_ext, $allowed_extensions)) {
                $flag = false;
                $profile_pic_msg = "Only JPG, JPEG, PNG files are allowed.";
            }
            // Check file size
            elseif ($file['size'] > $max_size) {
                $flag = false;
                $profile_pic_msg = "File size must be less than 5MB.";
            }
            // Check for valid image file
            elseif (!getimagesize($file['tmp_name'])) {
                $flag = false;
                $profile_pic_msg = "Uploaded file is not a valid image.";
            }
            
            // If all validations pass, move the file
            if ($flag) {
                $upload_dir = "uploads/";
                if (!is_dir($upload_dir)) {
                    mkdir($upload_dir, 0755, true);
                }
                $new_filename = uniqid() . '_' . basename($file['name']);
                $target_path = $upload_dir . $new_filename;
                
                if (!move_uploaded_file($file['tmp_name'], $target_path)) {
                    $flag = false;
                    $profile_pic_msg = "Failed to save uploaded file.";
                }
            }
        }
    } else {
        $flag = false;
        $profile_pic_msg = "Profile picture is required.";
    }

    /*-------Final Submission Check---------------*/
    if ($flag) {
        echo "Form submitted successfully!";
    } else {
        // header("location:login.php?msg_please_login_here");
    }
	}


	?>