<!-- edit profile pic start -->
    <?php
    session_start();
    require_once("require/database_connection.php");
    require_once("General.php");
    require_once("function.php");
    General::site_header();
    General::site_navbar();


    if (!isset($_SESSION['users'])) {
        header("Location: login.php");
        exit();
    }

    $user = $_SESSION['users'];
    $errors = [];

    if (isset($_POST['first_name'])) {
        $user_id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $date_of_birth = $_POST['date_of_birth'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        // Basic Validation
        if (empty($first_name)) $errors['first_name'] = "First name required.";
        if (empty($last_name)) $errors['last_name'] = "Last name required.";
        if (empty($password)) $errors['password'] = "Password required.";
        if (empty($date_of_birth)) $errors['date_of_birth'] = "Date of birth required.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Invalid email.";
        if (empty($address)) $errors['address'] = "Address required.";

        // Image Upload Handling
        $image_path = $user['user_image'];
        if (!empty($_FILES['profile_pic']['name'])) {
            $upload_dir = "uploads/";
            $file_name = basename($_FILES['profile_pic']['name']);
            $target_file = $upload_dir . $file_name;
            $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Allow only certain image types
            if (in_array($image_type, ['jpg', 'jpeg', 'png', 'gif'])) {
                if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
                    $image_path = $target_file;
                } else {
                    $errors['profile_pic'] = "Image upload failed.";
                }
            } else {
                $errors['profile_pic'] = "Only JPG, PNG, or GIF files allowed.";
            }
        }

        // Update if no error
        if (empty($errors)) {
            $sql = "UPDATE user SET 
                first_name = '$first_name',
                last_name = '$last_name',
                password = '$password',
                date_of_birth = '$date_of_birth',
                email = '$email',
                address = '$address',
                user_image = '$image_path'
                WHERE user_id = $user_id";

            if (mysqli_query($connection, $sql)) {
                // Update session
                $_SESSION['users'] = [
                    'user_id' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'password' => $password,
                    'date_of_birth' => $date_of_birth,
                    'email' => $email,
                    'address' => $address,
                    'user_image' => $image_path,
                    'role_id' => $user['role_id']
                ];

                // Redirect after success
                header("Location: " . ($user['role_id'] == 2 ? "main.php" : "admin_file.php"));
                exit();
            } else {
                $errors['general'] = "Something went wrong!";
            }
        }
    }
    ?>

    <!-- Simple Form UI -->
    <!DOCTYPE html>
    <html>
    <head>
        <title>Edit Profile</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    </head>
    <!-- <body class="container"> -->
        <h3>Edit Profile</h3>

        <?php if (isset($errors['general'])): ?>
            <div class="alert alert-danger"><?= $errors['general'] ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">

            <div class="mb-3">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?= $user['first_name'] ?>">
                <div class="text-danger"><?= $errors['first_name'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?= $user['last_name'] ?>">
                <div class="text-danger"><?= $errors['last_name'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?= $user['password'] ?>">
                <div class="text-danger"><?= $errors['password'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth" class="form-control" value="<?= $user['date_of_birth'] ?>">
                <div class="text-danger"><?= $errors['date_of_birth'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>">
                <div class="text-danger"><?= $errors['email'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="<?= $user['address'] ?>">
                <div class="text-danger"><?= $errors['address'] ?? '' ?></div>
            </div>

            <div class="mb-3">
                <label>Profile Picture</label><br>
                <img src="<?= $user['user_image'] ?>" width="100" class="img-thumbnail mb-2">
                <input type="file" name="profile_pic" class="form-control">
                <div class="text-danger"><?= $errors['profile_pic'] ?? '' ?></div>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </body>
    </html>

        <?php
        General::site_footer();
        General::footer_scripts();
        ?>
<!-- edit profile pic end -->
