<!-- database post view             -->

            <?php
            session_start();
            require_once("General.php");
            require_once("function.php");
            require_once("require/database_connection.php");

            General::site_header();
            General::site_navbar();


            if (!isset($_SESSION['users']['user_id'])) {
                header("Location: login.php");
                exit;
            }

            

            $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

            $post_sql = "SELECT * FROM post WHERE post_id = '$post_id'";
            $post_result = mysqli_query($connection, $post_sql);
            if ($row = mysqli_fetch_assoc($post_result)) {
                $img = $row["featured_image"];
                $title = $row["post_title"];
                $summary = $row["post_summary"];
                $description = $row["post_description"];
                $is_comment_allowed = $row["is_comment_allowed"];
            } else {
                echo "Post not found."; exit;
            }

            

            // Submit Comment
            if (isset($_POST['comment']) && !empty(trim($_POST['comment']))) {
                $user_id = $_SESSION['users']['user_id'];
                $comment = mysqli_real_escape_string($connection, trim($_POST['comment']));
                $insert = "INSERT INTO post_comment (post_id, user_id, comment, is_active, created_at)
                           VALUES ('$post_id', '$user_id', '$comment', 'Active', NOW())";
                mysqli_query($connection, $insert);
            }

            // Get Comments
            $comment_sql = "SELECT pc.comment, pc.created_at, u.first_name
                            FROM post_comment pc
                            JOIN user u ON pc.user_id = u.user_id
                            WHERE pc.post_id = '$post_id' AND pc.is_active = 'active'
                            ORDER BY pc.created_at DESC";
            $comments = mysqli_query($connection, $comment_sql);
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>My_Blog</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            </head>
            <body class="bg-light">

            <div class="container">
                <div class="card mb-4">
                    <?php if (!empty($row['featured_image']) && file_exists('Admin/' . $row['featured_image'])): ?>
                <img src="<?php echo 'Admin/' . htmlspecialchars($row['featured_image']); ?>" class="card-img-top featured-image" alt="Featured Image">
            <?php else: ?>
                <img src="images/default.jpg" class="card-img-top featured-image" alt="Default Image">
            <?php endif; ?>

                    <div class="card-body">
                        <h3><?php echo $title; ?></h3>
                        <p><?php echo nl2br($summary); ?></p>
                        <?php if (!empty($description)): ?>
                            <hr>
                            <p><?php echo nl2br($description); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if ($is_comment_allowed == 1): ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>Leave a Comment</h5>
                            <form method="POST">
                                <textarea name="comment" class="form-control mb-2" rows="3" required></textarea>
                                <button class="btn btn-sm btn-primary">Post</button>
                            </form>
                        </div>
                    </div>

                    <div>
                        <h5>Comments</h5>
                        <?php if (mysqli_num_rows($comments) > 0): ?>
                            <?php while ($c = mysqli_fetch_assoc($comments)): ?>
                                <div class="border rounded p-2 mb-2 bg-white">
                                    <strong><?php echo $c['first_name']; ?></strong>
                                    <small class="text-muted float-end"><?php echo date("d M Y, h:i A", strtotime($c['created_at'])); ?></small>
                                    <p class="mb-0"><?php echo nl2br($c['comment']); ?></p>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <p>No comments yet.</p>
                        <?php endif; ?>
                    
                <?php else: ?>
                    <div class="alert alert-info text-center">Comments are disabled for this post.</div>
                <?php endif; ?>
            </div>
        </div>

            <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
            </body>
            </html>

            <?php
        General::site_footer();
        General::footer_scripts();
        ?>
          
<!-- database post view             -->
            
