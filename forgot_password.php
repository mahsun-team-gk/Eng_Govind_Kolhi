<!-- forgot passowrd        -->
        <?php
        session_start();
        require_once("General.php");
        require_once("require/database_connection.php");
        use PHPMailer\PHPMailer\PHPMailer;
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/Exception.php';

        General::site_header();
        General::site_navbar();

        $email_msg = $success_msg = $error_msg = "";

        if (isset($_POST['reset_request'])) {
            $email = trim($_POST['email']);
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_msg = "Please enter a valid email.";
            } else {
                $result = mysqli_query($connection, "SELECT * FROM user WHERE email='$email'");
                if (mysqli_num_rows($result) === 1) {
                    $token = bin2hex(random_bytes(16));
                    mysqli_query($connection, "UPDATE user SET reset_token='$token', reset_at=NOW() WHERE email='$email'");

                    $reset_link = "http://localhost/reset_password.php?email=$email&token=$token";
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'phpbasic2k25@gmail.com';
                        $mail->Password = 'sffymqljdnupfzjc';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('phpbasic2k25@gmail.com', 'Blog Team');
                        $mail->addAddress($email);
                        $mail->Subject = 'Reset Your Password';
                        $mail->Body = "Click the link below to reset your password:\n$reset_link";

                        $mail->send();
                        $success_msg = "Reset link sent to your email.";
                    } catch (Exception $e) {
                        $error_msg = "Email failed: " . $mail->ErrorInfo;
                    }
                } else {
                    $error_msg = "Email not registered.";
                }
            }
        }
        ?>

        <div class="container mt-5">
            <h3>Forgot Password</h3>
            <?php if ($success_msg): ?><div class="alert alert-success"><?= $success_msg ?></div><?php endif; ?>
            <?php if ($error_msg): ?><div class="alert alert-danger"><?= $error_msg ?></div><?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                    <small class="text-danger"><?= $email_msg ?></small>
                </div>
                <button type="submit" name="reset_request" class="btn btn-primary">Send Reset Link</button>
            </form>
        </div>
<!-- forgot passowrd        -->
