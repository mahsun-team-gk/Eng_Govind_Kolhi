<!-- send feedback        -->

        <?php
        require_once("require/database_connection.php");
        use PHPMailer\PHPMailer\PHPMailer;
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/Exception.php';

        session_start();
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        function sendMail($to, $toName, $subject, $body, $replyToEmail = null, $replyToName = null) {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPAuth = true;
            $mail->Username = 'phpbasic2k25@gmail.com';
            $mail->Password = 'sffymqljdnupfzjc';

            $mail->setFrom('phpbasic2k25@gmail.com', 'Blog Team');
            $mail->addAddress($to, $toName);
            if ($replyToEmail && $replyToName) {
                $mail->addReplyTo($replyToEmail, $replyToName);
            }
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
        }

        if (isset($_POST['name'], $_POST['email'], $_POST['message'])) {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);

            if ($name === '' || $email === '' || $message === '') {
                $_SESSION['feedback_error'] = "All fields are required.";
                header("Location: " . ($user_id ? "main.php" : "login.php"));
                exit;
            }

            // Escape inputs for safe query
            $name_esc = mysqli_real_escape_string($connection, $name);
            $email_esc = mysqli_real_escape_string($connection, $email);
            $message_esc = mysqli_real_escape_string($connection, $message);

            if ($user_id) {
                $query = "INSERT INTO user_feedback (user_id, user_name, user_email, feedback, created_at) 
                          VALUES ($user_id, '$name_esc', '$email_esc', '$message_esc', NOW())";
            } else {
                $query = "INSERT INTO user_feedback (user_name, user_email, feedback, created_at) 
                          VALUES ('$name_esc', '$email_esc', '$message_esc', NOW())";
            }

            if (!mysqli_query($connection, $query)) {
                $_SESSION['feedback_error'] = "Database error. Please try again.";
                header("Location: " . ($user_id ? "main.php" : "login.php"));
                exit;
            }

            $loginStatus = $user_id ? "Logged in (User ID: $user_id)" : "Not logged in";

            $adminBody = "Name: $name\nEmail: $email\nStatus: $loginStatus\n\nFeedback:\n$message";
            $userBody = "Dear $name,\n\nThank you for your feedback.\n\nLogin Status: $loginStatus\n\n" .
                        ($user_id ? "We've received your message and will review it shortly." : 
                                    "We've received your message as a guest. Consider registering for a better experience.");

            try {
                sendMail('phpbasic2k25@gmail.com', 'Admin', 'New Feedback Received', $adminBody, $email, $name);
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    sendMail($email, $name, 'Thank you for your feedback', $userBody);
                }

                $_SESSION['feedback_success'] = $user_id 
                    ? "Your feedback has been sent to the admin. Thank you!" 
                    : "Thank you for your feedback! Your message has been recorded. You're not logged in.";
                header("Location: main.php");
                exit;

            } catch (Exception $e) {
                $_SESSION['feedback_error'] = "Feedback saved, but email failed: " . $e->getMessage();
                header("Location: " . ($user_id ? "main.php" : "login.php"));
                exit;
            }
        } else {
            // If form not submitted correctly, redirect to form page
            header("Location: " . ($user_id ? "main.php" : "login.php"));
            exit;
        }
        ?>
<!-- send feedback        -->
        
