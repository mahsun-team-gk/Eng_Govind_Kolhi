<!-- Show Comments -->
    <div class="card">
    <div class="card-header">Comments</div>
    <div class="card-body">
        <?php
    require_once("require/database_connection.php");
        
        $query = "SELECT c.comment, c.created_at, u.name 
                  FROM post_comment c 
                  JOIN users u ON c.user_id = u.user_id 
                  WHERE c.post_id = '$post_id' AND c.is_active = 1 
                  ORDER BY c.created_at DESC";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="mb-3 border-bottom pb-2">';
                echo '<strong>' . htmlspecialchars($row['name']) . '</strong> ';
                echo '<small class="text-muted">on ' . date("d M Y, h:i A", strtotime($row['created_at'])) . '</small>';
                echo '<p class="mb-0">' . nl2br(htmlspecialchars($row['comment'])) . '</p>';
                echo '</div>';
            }
        } else {
            echo "<p>No comments yet. Be the first to comment!</p>";
        }
        ?>
    </div>
    </div>
<!-- Show Comments -->

