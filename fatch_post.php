<!-- Fatch Posts Database -->

        <?php
        require_once("require/database_connection.php");

        $sql = "SELECT * FROM post ORDER BY created_at DESC ";
        $result = $connection->query($sql);

        if ($result && $result->num_rows > 0): ?>
            <div class="container mt-4">
                <div class="row g-4">
                    <?php while ($post = $result->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">

                            <?php if (!empty($post['featured_image']) && file_exists('uploads/' . $post['featured_image'])): ?>
                            <img src="Admin/uploads/<?= htmlspecialchars($post['featured_image']) ?>" class="card-img-top" alt="Featured Image" style="height: 200px; object-fit: cover;">
                            <?php else: ?>

                                <img src="images/default.jpg" class="card-img-top" alt="Default Image" style="height: 200px; object-fit: cover;">
                                
                                <?php endif; ?>

                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($post['post_title']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($post['post_summary']) ?></p>
                                    <a href="view_post.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Read More</a>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">No posts found.</p>
        <?php endif; ?>
<!-- Fatch Posts Database -->
        
