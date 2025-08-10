<!-- Fatch Blog Database -->

            <?php
            require_once("require/database_connection.php");

            // Fetch all blogs
            $sql = "SELECT * FROM blog ORDER BY created_at DESC";
            $result = $connection->query($sql);

            if (!$result) {
                die("Query failed: " . $connection->error);
            }
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Fatch Blog from database</title>
            </head>
            <body>
                <div class="row g-4">
                <?php
                if ($result->num_rows > 0) {
                    while ($blog = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100">

                                <?php if ($blog['blog_background_image']) : ?>
                                    <img src="uploads/<?= htmlspecialchars($blog['blog_background_image']) ?>" class="card-img-top" alt="Blog Image" style="height: 150px; object-fit: cover;">
                                <?php else: ?>
                                    <img src="images/default.jpg" class="card-img-top" alt="Default Image" style="height: 150px; object-fit: cover;">
                                <?php endif; ?>

                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted small">Posted on <?= date('F j, Y', strtotime($blog['created_at'])) ?></span>
                                        <span class="text-muted small">By User <?= htmlspecialchars($blog['user_id']) ?></span>
                                    </div>
                                    <h5 class="card-title"><?= htmlspecialchars($blog['blog_title']) ?></h5>
                                    <p class="card-text">Posts per page: <?= (int)$blog['post_per_page'] ?></p>
                                    <a href="posts.php?blog_id=<?= $blog['blog_id'] ?>" class="btn btn-primary mt-auto align-self-start">View Posts</a>
                                </div>
                                <div class="card-footer bg-white">
                                    <button class="btn btn-sm btn-outline-success float-end">Follow</button>
                                </div>
                            </div>
                        </div>
                        
                    <?php
                    }
                    } else {
                    echo "<p>No blogs found.</p>";
                    }
                    ?>
            </div>
            </body>
            </html>
<!-- Fatch Blog Database -->
