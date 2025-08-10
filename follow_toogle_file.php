<!-- folow toogle file of blog -->
        <?php
        session_start();
        require_once("require/database_connection.php");

        if (!isset($_SESSION['users']['user_id'])) {
            echo "unauthorized";
            exit;
        }

        $loggedInUserId = $_SESSION['users']['user_id'];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $blogId = intval($_POST['blog_id']);
            $action = $_POST['action'];

            if ($action === "follow") {
                $check = $connection->query("SELECT * FROM following_blog WHERE follower_id = $loggedInUserId AND blog_following_id = $blogId");
                if ($check->num_rows == 0) {
                    $insert = $connection->query("INSERT INTO following_blog (follower_id, blog_following_id, status) VALUES ($loggedInUserId, $blogId, 1)");
                    if ($insert) {
                        echo "followed";
                    } else {
                        echo "error";
                    }
                } else {
                    $update = $connection->query("UPDATE following_blog SET status = 1 WHERE follower_id = $loggedInUserId AND blog_following_id = $blogId");
                    echo "followed";
                }
            } elseif ($action === "unfollow") {
                $update = $connection->query("UPDATE following_blog SET status = 0 WHERE follower_id = $loggedInUserId AND blog_following_id = $blogId");
                echo "unfollowed";
            } else {
                echo "invalid";
            }
        }
        ?>
<!-- folow toogle file of blog -->
