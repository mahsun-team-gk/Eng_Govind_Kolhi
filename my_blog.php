<!-- blog  main file      -->
    <?php
    session_start();
    require_once("require/database_connection.php");
    require_once("function.php");
    require_once("General.php");

    if (!isset($_SESSION['users']['user_id'])) {
        header("Location: login.php");
        exit;
    }
    $userId = $_SESSION['users']['user_id'];
    General::site_header();
    General::site_navbar();

    // Get setting helper
    function get_setting($con, $user_id, $key) {
        $sql = "SELECT setting_value FROM setting WHERE user_id = $user_id AND setting_key = '$key' LIMIT 1";
        $res = mysqli_query($con, $sql);
        return ($row = mysqli_fetch_assoc($res)) ? $row['setting_value'] : '';
    }
    ?>

    <div class="container-fluid p-0" id="my_blog">
        <div class="row px-0">
            <div class="col-sm-12">
                <h1 class="bg-warning-subtle text-center py-2 mb-0">Blog</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">

            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white"><h5 class="mb-0">Recent Posts</h5></div>
                    <div class="list-group list-group-flush">
                        <?php
                        $recent = mysqli_query($connection, "SELECT post_id, post_title FROM post WHERE post_status='Active' ORDER BY created_at DESC LIMIT 5");
                        if (mysqli_num_rows($recent) > 0) {
                            while ($r = mysqli_fetch_assoc($recent)) {
                                echo '<a href="view_post.php?post_id=' . $r['post_id'] . '" class="list-group-item">' . htmlspecialchars($r['post_title']) . '</a>';
                            }
                        } else {
                            echo '<div class="list-group-item">No recent posts.</div>';
                        }
                        ?>
                    </div>
                </div>

                <div class="card mt-3 mb-4">
                    <div class="card-header bg-primary text-white"><h5 class="mb-0">Categories</h5></div>
                    <div class="list-group list-group-flush">
                        <?php
                        $cats = mysqli_query($connection, "SELECT category_title, category_description FROM category WHERE category_status='Active' ORDER BY category_id DESC");
                        while ($cat = mysqli_fetch_assoc($cats)) {
                            echo '<a href="my_blog.php?category=' . urlencode($cat['category_title']) . '" class="list-group-item">' . htmlspecialchars($cat['category_title']) . '<br><small>' . htmlspecialchars($cat['category_description']) . '</small></a>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Main Section -->
            <div class="col-lg-9">

                <!-- Blog Settings -->
                <div class="card mb-4">
                    <div class="card-header bg-light-subtle">Blog Settings</div>
                    <div class="card-body">
                        <?php
                        if (isset($_POST['save_settings'])) {
                            $title_color = $_POST['title_color'];
                            $bg_color = $_POST['background_color'];
                            $font = $_POST['font_style'];
                            $settings = ['title_color' => $title_color, 'background_color' => $bg_color, 'font_style' => $font];

                            foreach ($settings as $key => $val) {
                                $check = mysqli_query($connection, "SELECT * FROM setting WHERE user_id = $userId AND setting_key = '$key'");
                                if (mysqli_num_rows($check) > 0) {
                                    mysqli_query($connection, "UPDATE setting SET setting_value='$val', updated_at=NOW() WHERE user_id=$userId AND setting_key='$key'");
                                } else {
                                    mysqli_query($connection, "INSERT INTO setting (user_id, setting_key, setting_value, setting_status, created_at, updated_at) VALUES ($userId, '$key', '$val', 'Active', NOW(), NOW())");
                                }
                            }
                            echo '<div class="alert alert-success">Settings saved.</div>';
                        }

                        $title_color = get_setting($connection, $userId, 'title_color');
                        $bg_color = get_setting($connection, $userId, 'background_color');
                        $font = get_setting($connection, $userId, 'font_style');
                        ?>

                        <form method="POST">
                            <label>Post Title Color</label>
                            <input type="color" name="title_color" class="form-control" value="<?= $title_color ?>"><br>
                            <label>Post Background Color</label>
                            <input type="color" name="background_color" class="form-control" value="<?= $bg_color ?>"><br>
                            <label>Font Style</label>
                            <select name="font_style" class="form-select">
                                <option value="">Select Font</option>
                                <option value="Arial" <?= ($font == 'Arial') ? 'selected' : '' ?>>Arial</option>
                                <option value="Georgia" <?= ($font == 'Georgia') ? 'selected' : '' ?>>Georgia</option>
                                <option value="Verdana" <?= ($font == 'Verdana') ? 'selected' : '' ?>>Verdana</option>
                            </select><br>
                            <button type="submit" name="save_settings" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>

                <!-- Search Form -->
                <form class="mb-4" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search..." value="<?= $_GET['search'] ?? '' ?>">
                        <button type="submit" class="btn btn-outline-secondary">Search</button>
                    </div>
                </form>

                <!-- Blog Cards -->
                <div class="row g-4">
                    <?php
                    $limit = 6;
                    $page = $_GET['page'] ?? 1;
                    $offset = ($page - 1) * $limit;
                    $search = mysqli_real_escape_string($connection, $_GET['search'] ?? '');
                    $where = "WHERE blog_status='Active'";
                    if ($search) {
                        $where .= " AND (blog_title LIKE '%$search%' OR blog_description LIKE '%$search%')";
                    }

                    $totalRes = mysqli_query($connection, "SELECT COUNT(*) AS total FROM blog $where");
                    $total = mysqli_fetch_assoc($totalRes)['total'];
                    $pages = ceil($total / $limit);

                    $blogs = mysqli_query($connection, "SELECT * FROM blog $where ORDER BY created_at DESC LIMIT $limit OFFSET $offset");

                    if (mysqli_num_rows($blogs) > 0) {
                        while ($b = mysqli_fetch_assoc($blogs)) {
                            $follow = mysqli_query($connection, "SELECT * FROM following_blog WHERE follower_id=$userId AND blog_following_id={$b['blog_id']} AND status=1");
                            $isFollow = mysqli_num_rows($follow) > 0;
                            $style = "background-color:$bg_color;font-family:$font;";
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100" style="<?= $style ?>">
                                    

                                    <img src="<?= $b['blog_background_image'] ? 'Admin/uploads/' . $b['blog_background_image'] : 'images/default.jpg' ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                                    <div class="card-body d-flex flex-column">
                                        <small class="text-muted mb-2">Posted on <?= date('F j, Y', strtotime($b['created_at'])) ?> | User <?= $b['user_id'] ?></small>
                                        <h5 class="card-title" style="color:<?= $title_color ?>"><?= htmlspecialchars($b['blog_title']) ?></h5>
                                        <a href="posts.php?blog_id=<?= $b['blog_id'] ?>" class="btn btn-primary mt-auto">View Posts</a>
                                    </div>
                                    <div class="card-footer text-end bg-white">
                                        <button class="btn btn-sm <?= $isFollow ? 'btn-outline-danger' : 'btn-outline-success' ?> follow-toggle" data-blog-id="<?= $b['blog_id'] ?>" data-action="<?= $isFollow ? 'unfollow' : 'follow' ?>">
                                            <?= $isFollow ? 'Unfollow' : 'Follow' ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else {
                        echo '<div class="alert alert-warning">No blogs found.</div>';
                    }
                    ?>
                </div>

                <!-- Pagination -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a></li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $pages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <?php if ($page < $pages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script>
    document.querySelectorAll(".follow-toggle").forEach(btn => {
        btn.addEventListener("click", function () {
            let blogId = this.dataset.blogId;
            let action = this.dataset.action;
            fetch("follow_toogle_file.php", {
                method: "POST",
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `blog_id=${blogId}&action=${action}`
            })
            .then(res => res.text())
            .then(res => {
                if (res.trim() === 'followed') {
                    this.textContent = "Unfollow";
                    this.classList.replace("btn-outline-success", "btn-outline-danger");
                    this.dataset.action = "unfollow";
                } else if (res.trim() === 'unfollowed') {
                    this.textContent = "Follow";
                    this.classList.replace("btn-outline-danger", "btn-outline-success");
                    this.dataset.action = "follow";
                }
            });
        });
    });
    </script>

    <?php
    General::site_footer();
    General::footer_scripts();
    ?>
<!-- blog  main file      -->
    
