<!-- post main file of database  -->
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

        // ===================== START: Build Query =====================
        $limit = 6;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        $where = "WHERE post_status = 'Active'";

        if (!empty($_GET['title'])) {
            $where .= " AND post_title LIKE '%" . mysqli_real_escape_string($connection, $_GET['title']) . "%'";
        }
        if (!empty($_GET['author'])) {
            $where .= " AND author_name LIKE '%" . mysqli_real_escape_string($connection, $_GET['author']) . "%'";
        }
        if (!empty($_GET['date'])) {
            $where .= " AND DATE(created_at) = '" . mysqli_real_escape_string($connection, $_GET['date']) . "'";
        }

        $count_query = mysqli_query($connection, "SELECT COUNT(*) AS total FROM post $where");
        $count_row = mysqli_fetch_assoc($count_query);
        $total_posts = $count_row['total'];

        $post_query = "SELECT * FROM post $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
        $posts = mysqli_query($connection, $post_query);
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>My Posts</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>
        <body>

        <!-- ===================== START: Search Bar ===================== -->
        <div class="container mt-3">
            <form method="GET">
                <div class="row g-2">
                    <div class="col-md-4"><input type="text" name="title" class="form-control" placeholder="Search by Title" value="<?= htmlspecialchars($_GET['title'] ?? '') ?>"></div>
                    <div class="col-md-4"><input type="text" name="author" class="form-control" placeholder="Search by Author" value="<?= htmlspecialchars($_GET['author'] ?? '') ?>"></div>
                    <div class="col-md-4"><input type="date" name="date" class="form-control" value="<?= htmlspecialchars($_GET['date'] ?? '') ?>"></div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="?" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
        <!-- ===================== END: Search Bar ===================== -->

        <!-- ===================== START: Post Display ===================== -->
        <div class="container mt-4 mb-5">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row g-4">
                        <?php if (mysqli_num_rows($posts) > 0): ?>
                            <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100">

                                        <?php
                                        // Prepare image URL and check file existence on server
                                        $img = $post['featured_image'] ?? '';
                                        $img_path = 'Admin/' . $img; // Path for HTML (URL)
                                        $img_file_path = __DIR__ . '/' . $img_path; // Server file system path

                                        if (!empty($img) && file_exists($img_file_path)):
                                        ?>
                                            <img src="<?= htmlspecialchars($img_path) ?>" class="card-img-top featured-image" alt="Featured Image" style="max-height:200px; object-fit:cover;">
                                        <?php else: ?>
                                            <img src="images/default.jpg" class="card-img-top featured-image" alt="Default Image" style="max-height:200px; object-fit:cover;">
                                        <?php endif; ?>

                                        <div class="card-body">
                                            <h5><?= htmlspecialchars($post['post_title']) ?></h5>
                                            <p><?= htmlspecialchars($post['post_summary']) ?></p>
                                            <a href="view_post.php?post_id=<?= (int)$post['post_id'] ?>" class="btn btn-primary">Read More</a>
                                        </div>
                                        <div class="card-footer">
                                            <small>Posted on <?= date('F j, Y', strtotime($post['created_at'])) ?></small>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="alert alert-warning">No posts found.</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- ===================== START: Sidebar ===================== -->
                <div class="col-lg-3">
                    <!-- Recent Posts -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white"><h5 class="mb-0">Recent Posts</h5></div>
                        <div class="list-group list-group-flush">
                            <?php
                            $recent = mysqli_query($connection, "SELECT post_id, post_title FROM post WHERE post_status='Active' ORDER BY created_at DESC LIMIT 5");
                            if (mysqli_num_rows($recent) > 0) {
                                while ($row = mysqli_fetch_assoc($recent)) {
                                    echo '<a href="view_post.php?post_id=' . (int)$row['post_id'] . '" class="list-group-item list-group-item-action">' . htmlspecialchars($row['post_title']) . '</a>';
                                }
                            } else {
                                echo '<div class="list-group-item">No recent posts.</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white"><h5 class="mb-0">Categories</h5></div>
                        <div class="list-group list-group-flush">
                            <?php
                            $categories = mysqli_query($connection, "SELECT category_title, category_description FROM category WHERE category_status='Active' ORDER BY category_id DESC");
                            if (mysqli_num_rows($categories) > 0) {
                                while ($cat = mysqli_fetch_assoc($categories)) {
                                    echo '<a href="my_blog.php?category=' . urlencode($cat['category_title']) . '" class="list-group-item list-group-item-action">';
                                    echo htmlspecialchars($cat['category_title']) . '<br><small class="text-muted">' . htmlspecialchars($cat['category_description']) . '</small></a>';
                                }
                            } else {
                                echo '<div class="list-group-item">No categories found.</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- ===================== END: Post Display ===================== -->

<!-- ===================== START: Pagination ===================== -->
        <?php
        $total_pages = ceil($total_posts / $limit);
        if ($total_pages > 1):
        ?>
            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>">Previous</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Next</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
        <!-- ===================== END: Pagination ===================== -->

        <?php
        General::site_footer();
        General::footer_scripts();
        ?>
        </body>
        </html>
<!-- post main file of database  -->

