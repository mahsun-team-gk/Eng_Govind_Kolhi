// login process start
      
            <?php
            session_start();
            require_once("require/database_connection.php");

            if (isset($_REQUEST["login"])) {
                $email = $_REQUEST["email"];
                $password = $_REQUEST["password"];

                $stmt = $connection->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    
                    // Single condition for successful login
                    if (strtolower($user['is_approved']) == 'approved' && strtolower($user['is_active']) == 'active') {
                        $_SESSION['users'] = $user;
                        
                        if ($user['role_id'] == 1) {
                            header("Location: Admin/admin_file.php");
                        } elseif ($user['role_id'] == 2) {
                            header("Location: main.php");
                        } else {
                            header("Location: login.php?error=Unknown user role");
                        }
                        exit();
                        } 
                    // Single else for all other cases
                    else {
                        header("Location: login.php?error=Your account is pending approval. Please wait or contact support.");
                        exit();
                    }
                    } else {
                    header("Location: login.php?error=Invalid email or password");
                    exit();
                    }
                    }
                

                     mysqli_close($connection);

