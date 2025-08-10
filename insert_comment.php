<!-- insert commments     -->
    <?php
    session_start();
    require_once("require/database_connection.php");

    // Get current post ID from URL
    $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
    $user_id = $_SESSION['user_id'] ?? null;

    // Check if comments are allowed for this post
    $check_query = "SELECT is_comment_allowed FROM post WHERE post_id = '$post_id' LIMIT 1";
    $check_result = mysqli_query($connection, $check_query);
    $allow_comment = 0;

    if ($check_result && $row = mysqli_fetch_assoc($check_result)) {
        $allow_comment = $row['is_comment_allowed'];
    }

    // Handle comment submission
    if (isset($_POST['submit_comment'], $_POST['comment']) && $user_id && $allow_comment == 1) {
        $comment = mysqli_real_escape_string($connection, $_POST['comment']);

        $insert = "INSERT INTO post_comment (post_id, user_id, comment, is_active, created_at)
                   VALUES ('$post_id', '$user_id', '$comment', 1, NOW())";

        mysqli_query($connection, $insert);
    }
    ?>

    <!-- Leave a Comment -->
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-header bg-white fw-bold fs-5">Leave a Comment</div>
        <div class="card-body">
            <?php if (!$allow_comment): ?>
                <div class="alert alert-secondary mb-0">Commenting is disabled for this post.</div>
            <?php elseif (!$user_id): ?>
                <div class="alert alert-warning mb-0">Please log in to post a comment.</div>
            <?php else: ?>
                <form method="post">
                    <div class="mb-3">
                        <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment..." required></textarea>
                    </div>
                    <button type="submit" name="submit_comment" class="btn btn-primary">Post Comment</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Display Comments -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold fs-5">Comments</div>
        <div class="card-body">
            <?php
            $comments_query = "SELECT pc.comment, pc.created_at, u.username 
                               FROM post_comment pc
                               JOIN users u ON pc.user_id = u.user_id
                               WHERE pc.post_id = '$post_id' AND pc.is_active = 1
                               ORDER BY pc.created_at DESC";

            $comments_result = mysqli_query($connection, $comments_query);

            if ($comments_result && mysqli_num_rows($comments_result) > 0) {
                while ($row = mysqli_fetch_assoc($comments_result)) {
                    echo '
                    <div class="mb-3 border-bottom pb-2">
                        <div class="fw-bold text-primary">' . htmlspecialchars($row['username']) . '</div>
                        <div class="small text-muted">' . date('F j, Y, g:i a', strtotime($row['created_at'])) . '</div>
                        <p class="mb-0">' . htmlspecialchars($row['comment']) . '</p>
                    </div>';
                }
            } else {
                echo '<p class="text-muted mb-0">No comments yet.</p>';
            }
            ?>
        </div>
    </div>
<!-- insert commments     -->
