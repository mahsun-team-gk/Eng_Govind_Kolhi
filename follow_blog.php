<!-- follow blog         -->
        <?php
        session_start();
        require_once("require/database_connection.php");

        $blog_id = $_GET['blog_id']; // Blog to follow
        $user_id = $_SESSION['user_id']; // Logged-in user

        // Check if already following
        $check_sql = "SELECT * FROM following_blog WHERE follower_id = '$user_id' AND blog_following_id = '$blog_id'";
        $check_result = $connection->query($check_sql);

        if ($check_result->num_rows > 0) {
            echo "<button class='btn btn-secondary' disabled>Following</button>";
        } else {
            echo "
            <form method='POST'>
                <input type='hidden' name='blog_id' value='$blog_id'>
                <button type='submit' name='follow' class='btn btn-primary'>Follow Blog</button>
            </form>
            ";
        }
        ?>

        <?php
        if (isset($_POST['follow'])) {
            $blog_id = $_POST['blog_id'];
            $user_id = $_SESSION['user_id'];
            $created_at = date('Y-m-d H:i:s');
            $updated_at = date('Y-m-d H:i:s');
            $status = 1; // Active

            // Insert follow record
            $insert_sql = "INSERT INTO following_blog (follower_id, blog_following_id, status, created_at, updated_at)
                           VALUES ('$user_id', '$blog_id', '$status', '$created_at', '$updated_at')";

            if ($connection->query($insert_sql)) {
                echo "<script>location.reload();</script>";
            } else {
                echo "Error: " . $connection->error;
            }
        }
        ?>

        <?php
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT b.blog_title FROM blog b 
                JOIN following_blog f ON f.blog_following_id = b.blog_id
                WHERE f.follower_id = '$user_id' AND f.status = 1";

        $result = $connection->query($sql);

        echo "<h5>Blogs You're Following:</h5>";
        while ($row = $result->fetch_assoc()) {
            echo "<p>" . htmlspecialchars($row['blog_title']) . "</p>";
        }
        ?>
<!-- follow blog         -->
