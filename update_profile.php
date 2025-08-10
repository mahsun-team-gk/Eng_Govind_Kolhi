<!-- update profile form database          -->
        <?php
        session_start();
        require_once("require/database_connection.php");

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            // Get form data
            $user_id = $_POST['user_id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $password = $_POST['password'];
            $date_of_birth = $_POST['date_of_birth'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            
            // Handle profile picture upload
            $image_name = $_SESSION['users']['user_image']; // Keep current image by default
            
            if (!empty($_FILES['profile_pic']['name'])) {
                $target_dir = "uploads/";
                $image_name = $target_dir . basename($_FILES['profile_pic']['name']);
                
                // Try to upload new image
                if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $image_name)) {
                    // Optionally delete old image here if needed
                }
            }

            // Update user in database
            $query = "UPDATE user SET 
                      first_name = '$first_name',
                      last_name = '$last_name',
                      password = '$password',
                      date_of_birth = '$date_of_birth',
                      email = '$email',
                      address = '$address',
                      user_image = '$image_name'
                      WHERE user_id = '$user_id'";
            
            if (mysqli_query($connection, $query)) {
                // Fetch updated role_id
                $role_query = "SELECT role_id FROM user WHERE user_id = '$user_id'";
                $role_result = mysqli_query($connection, $role_query);
                $role_data = mysqli_fetch_assoc($role_result);
                $role_id = $role_data['role_id'];

                // Update session with new data
                $_SESSION['users'] = [
                    'user_id' => $user_id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'password' => $password,
                    'date_of_birth' => $date_of_birth,
                    'email' => $email,
                    'address' => $address,
                    'user_image' => $image_name,
                    'role_id' => $role_id
                ];

                // Redirect based on role_id
                if ($role_id == 1) {
                    header("Location: main.php");
                } elseif ($role_id == 2) {
                    header("Location: Admin/admin_file.php");
                } else {
                    echo "Unknown role. Please contact support.";
                }
                exit();
            } else {
                echo "Error updating profile: " . mysqli_error($connection);
            }
        } else {
            echo "Invalid request.";
        }
        ?>
<!-- update profile form database          -->
