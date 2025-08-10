            <?php
            // session_start();
            require_once("require/database_connection.php");
            require_once("function.php");
            require_once("General.php");

            // Include PHPMailer only once
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            require 'PHPMailer/src/Exception.php';

            if (!isset($_SESSION['users']['user_id'])) {
                header("Location: login.php");
                exit;
            }

            $loggedInUserId = $_SESSION['users']['user_id'];
            General::site_header();
            General::site_navbar();

            // ✅ Define send_email only if it doesn't already exist
            if (!function_exists('send_email')) {
                function send_email($to, $subject, $message) {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'phpbasic2k25@gmail.com'; // Your Gmail
                        $mail->Password = 'sffymqljdnupfzjc';       // App password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('phpbasic2k25@gmail.com', 'Blog Team');
                        $mail->addAddress($to);
                        $mail->addReplyTo('phpbasic2k25@gmail.com');
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = $message;

                        $mail->send();
                        return true;
                    } catch (Exception $e) {
                        error_log("Email could not be sent. Mailer Error: " . $mail->ErrorInfo);
                        return false;
                    }
                }
            }

            // ✅ Handle AJAX follow/unfollow
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['blog_id'], $_POST['action'])) {
                $blogId = (int)$_POST['blog_id'];
                $action = $_POST['action'];

                if ($action === 'follow') {
                    $check = $connection->prepare("SELECT 1 FROM following_blog WHERE follower_id = ? AND blog_following_id = ?");
                    $check->bind_param("ii", $loggedInUserId, $blogId);
                    $check->execute();
                    $check->store_result();

                    if ($check->num_rows === 0) {
                        $insert = $connection->prepare("INSERT INTO following_blog (follower_id, blog_following_id, status, created_at, updated_at) VALUES (?, ?, 1, NOW(), NOW())");
                        $insert->bind_param("ii", $loggedInUserId, $blogId);
                        if ($insert->execute()) {
                            $blogInfo = $connection->query("SELECT blog_title FROM blog WHERE blog_id = $blogId")->fetch_assoc();
                            $userInfo = $connection->query("SELECT email, first_name FROM users WHERE user_id = $loggedInUserId")->fetch_assoc();

                            $subject = "You're following the blog: " . $blogInfo['blog_title'];
                            $message = "<p>Hello {$userInfo['first_name']},</p>
                                        <p>You are now following <strong>{$blogInfo['blog_title']}</strong>.</p>
                                        <p>We'll notify you when new posts are added.</p>";

                            send_email($userInfo['email'], $subject, $message);
                            echo "followed";
                            exit;
                        }
                    } else {
                        $update = $connection->prepare("UPDATE following_blog SET status = 1, updated_at = NOW() WHERE follower_id = ? AND blog_following_id = ?");
                        $update->bind_param("ii", $loggedInUserId, $blogId);
                        if ($update->execute()) {
                            echo "followed";
                            exit;
                        }
                    }
                } elseif ($action === 'unfollow') {
                    $update = $connection->prepare("UPDATE following_blog SET status = 0, updated_at = NOW() WHERE follower_id = ? AND blog_following_id = ?");
                    $update->bind_param("ii", $loggedInUserId, $blogId);
                    if ($update->execute()) {
                        echo "unfollowed";
                        exit;
                    }
                }

                echo "error";
                exit;
            }
            ?>

            <!-- ✅ HTML: Blog List -->
            <div class="container my-4">
                <div class="row">
                    <?php
                    $blogs = $connection->query("SELECT blog_id, blog_title FROM blog");
                    while ($row = $blogs->fetch_assoc()) {
                        $stmt = $connection->prepare("SELECT status FROM following_blog WHERE follower_id = ? AND blog_following_id = ?");
                        $stmt->bind_param("ii", $loggedInUserId, $row['blog_id']);
                        $stmt->execute();
                        $stmt->bind_result($status);
                        $isFollowing = $stmt->fetch() && $status == 1;
                        $stmt->close();
                    ?>
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5><?= htmlspecialchars($row['blog_title']) ?></h5>
                            <button class="btn follow-toggle <?= $isFollowing ? 'btn-outline-danger' : 'btn-outline-success' ?>"
                                    data-blog-id="<?= $row['blog_id'] ?>"
                                    data-action="<?= $isFollowing ? 'unfollow' : 'follow' ?>">
                                <?= $isFollowing ? 'Unfollow' : 'Follow' ?>
                            </button>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <!-- ✅ JS for AJAX Follow/Unfollow -->
            <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelectorAll(".follow-toggle").forEach(button => {
                    button.addEventListener("click", function () {
                        const blogId = this.dataset.blogId;
                        const action = this.dataset.action;

                        fetch(window.location.href, {
                            method: "POST",
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: `blog_id=${blogId}&action=${action}`
                        })
                        .then(res => res.text())
                        .then(data => {
                            if (data.trim() === "followed") {
                                this.textContent = "Unfollow";
                                this.classList.remove("btn-outline-success");
                                this.classList.add("btn-outline-danger");
                                this.dataset.action = "unfollow";
                            } else if (data.trim() === "unfollowed") {
                                this.textContent = "Follow";
                                this.classList.remove("btn-outline-danger");
                                this.classList.add("btn-outline-success");
                                this.dataset.action = "follow";
                            }
                        });
                    });
                });
            });
            </script>

            <?php
            General::site_footer();
            General::footer_scripts();
            ?>
