<!-- reset password of database          -->

        <?php
        session_start();
        require_once("General.php");
        require_once("require/database_connection.php");

        General::site_header();
        General::site_navbar();

        $error_msg = $password_msg = $success_msg = "";
        $email = $_GET['email'] ?? '';
        $token = $_GET['token'] ?? '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
            $email = $_POST['email'];
            $token = $_POST['token'];
            $new_password = trim($_POST['new_password']);
            $confirm_password = trim($_POST['confirm_password']);

            if ($new_password !== $confirm_password) {
                $password_msg = "Passwords do not match.";
                
            } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $new_password)) {
                $password_msg = "Password must include uppercase, lowercase, number, symbol and be 8+ characters.";
            } else {
                $result = mysqli_query($connection, "SELECT * FROM user WHERE email='$email' AND reset_token='$token'");
                if (mysqli_num_rows($result) === 1) {
                    mysqli_query($connection, "UPDATE user SET password='$new_password', reset_token=NULL WHERE email='$email'");
                    $success_msg = "Password successfully updated.";
                } else {
                    $error_msg = "Invalid token or email.";
                }
            }
        }
        ?>

        <div class="container mt-5">
            <h3>Reset Your Password</h3>
            <?php if ($success_msg): ?><div class="alert alert-success"><?= $success_msg ?></div><?php endif; ?>
            <?php if ($error_msg): ?><div class="alert alert-danger"><?= $error_msg ?></div><?php endif; ?>

            <form method="POST">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" required>
                    <small class="text-danger"><?= $password_msg ?></small>
                </div>
                <button type="submit" name="change_password" class="btn btn-success">Update Password</button>
            </form>
        </div>
<!-- reset password of database          -->
