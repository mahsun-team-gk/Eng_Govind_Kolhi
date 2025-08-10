            <!-- [post category] -->

<!--  Query to get all categories and their titles, descriptions, etc. -->

            <div class="col-lg-3">
                <h4 class="mb-4">Post Categories</h4>
                <ul class="list-group">
                    <?php
                    require_once("require/database_connection.php");

                    $category_query = "
                        SELECT c.category_id, c.category_title, c.category_description
                        FROM category c
                        ORDER BY c.category_title
                    ";
                    $cat_result = $connection->query($category_query);

                    if ($cat_result && $cat_result->num_rows > 0):
                        while ($cat = $cat_result->fetch_assoc()):
                    ?>
                            <li class="list-group-item">
                                <a href="category_post.php?category_id=<?= $cat['category_id'] ?>">
                                    <?= htmlspecialchars($cat['category_title']) ?>
                                </a>
                            </li>
                    <?php
                        endwhile;
                    else:
                    ?>
                        <li class="list-group-item">No categories found.</li>
                    <?php endif; ?>
                </ul>
                <hr>
            </div>
<!-- // Query to get all categories and their titles, descriptions, etc. -->



<!-- [post category] -->

            <!-- [posts in category] -->
            <div class="col-lg-9">
                <?php
                // Get category ID from URL parameter
                $category_id = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;

                if ($category_id > 0):
                    // Query to get posts in the selected category
                    $query = "
                        SELECT p.post_id, p.post_title, p.post_summary
                        FROM post_category pc
                        JOIN post p ON pc.post_id = p.post_id
                        WHERE pc.category_id = $category_id
                    ";
                    $result = $connection->query($query);
                ?>
                    <ul class="list-group">
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <li class="list-group-item">
                                    <a href="view_post.php?post_id=<?= $row['post_id'] ?>">
                                        <?= htmlspecialchars($row['post_title']) ?>
                                    </a>
                                    <p><?= htmlspecialchars($row['post_summary']) ?></p>
                                </li>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <li class="list-group-item">No posts found in this category.</li>
                        <?php endif; ?>
                    </ul>
                <?php else: ?>
                    <p>No category selected or invalid category ID.</p>
                <?php endif; ?>
            </div>
            
<!-- [post category] -->
