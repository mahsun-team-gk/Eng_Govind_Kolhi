<!-- main file start         -->

        <?php
        // session_start();
        require_once("require/database_connection.php");

    

            


        class General {
            public static function site_header() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Mind_Write</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- main file start         -->


<!-- Bootstrap 5 CSS -->
            <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
            <style>

    /* Your existing CSS styles */
        .navbar-nav .nav-link:hover { color: blue !important; }

        .navbar-nav .nav-link:hover {
                        color: black !important;
                    }
                    .navbar-nav .nav-link::after {
                        content: '';
                        position: absolute;
                        width: 0;
                        height: 2px;
                        bottom: 0;
                        left: 0;
                        background-color: blue;
                        transition: width 0.8s ease;
                    }
                    .navbar-nav .nav-link:hover::after {
                        width: 100%;
                    }
                    .hover-section {
                        transition: all 0.8s ease;
                    }
                    .hover-section:hover {
                        color: navy !important;
                    }
                    .navbar-nav .nav-link:hover {
                    color: blue !important; 
                        }
                        /* Sticky Top */
                    
                    .navbar {
                        top: 5px;
                        width: 100%;
                    }


                    
        /*   social-link*/
                        .social-link {
                            padding: 8px 12px;
                            border-radius: 4px;
                            text-decoration: none;
                            color: #495057;
                            transition: all 0.5s ease;
                            display: inline-block;
                            /*width: fit-content;*/
                        }
                        
                        .social-link:hover {
                            transform: translateY(-3px);
                            text-decoration: none;
                        }
                        
                        .facebook {
                            color: #1877f2 !important;
                            border: 1px solid #1877f2;
                        }
                        
                        .facebook:hover {
                            background-color: #1877f2;
                            color: white !important;
                        }
                        
                        .twitter {
                            color: #1da1f2 !important;
                            border: 1px solid #1da1f2;
                        }
                        
                        .twitter:hover {
                            background-color: #1da1f2;
                            color: white !important;
                        }
                        
                        .instagram {
                            color: #e4405f !important;
                            border: 1px solid #e4405f;
                        }
                        
                        .instagram:hover {
                            background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
                            color: white !important;
                            border-color: transparent;
                        }
                        
                        .linkedin {
                            color: #0a66c2 !important;
                            border: 1px solid #0a66c2;
                        }
                        
                        .linkedin:hover {
                            background-color: #0a66c2;
                            color: white !important;
                        }
                    </style>
<!-- Bootstrap 5 CSS -->


<!-- header section start     -->
            </head>
            <body>
            <?php
                }
// <!-- header section start     -->
                

// =================== NAVBAR SECTION ===================
                public static function site_navbar() {
            ?>
            <!-- Navbar Start -->
            <div class="container-fluid sticky-top px-0 text-center">
                <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                    <div class="container">
                        <a class="navbar-brand" href="main.php">
                            <img src="1.png" class="rounded-circle" alt="Mind Write Logo" width="80" height="70">
                            <span class="fw-bold mx-2">Mind Write</span>
                        </a>
                        
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item"><a class="nav-link fw-bold" href="main.php">Home</a></li>
                                <li class="nav-item"><a class="nav-link fw-bold" href="#posts">Posts</a></li>
                                <li class="nav-item"><a class="nav-link fw-bold" href="my_blog.php">Blog</a></li>
                                <li class="nav-item"><a class="nav-link fw-bold" href="contact_us.php">Contact US</a></li>
                                <li class="nav-item"><a class="nav-link fw-bold" href="#about">About</a></li>
                                <li class="nav-item"><a class="nav-link fw-bold" href="https://govind.mahsunsolutions.com/">Watch My Portfolio</a></li>
                            </ul>
                            
                            <!-- User Auth Section -->
                            <?php if (isset($_SESSION['users'])): ?>
                            <div class="dropdown">
                                <div class="user-info d-flex align-items-center dropdown-toggle" data-bs-toggle="dropdown">
                                    <img src="<?= $_SESSION['users']['user_image'] ?? 'default.png' ?>" 
                                         alt="User" class="rounded-circle me-2" width="40" height="40">
                                    <span class="fw-bold"><?= htmlspecialchars($_SESSION['users']['first_name'] ?? 'User') ?></span>
                                    <span class="fw-bold"><?= htmlspecialchars($_SESSION['users']['last_name'] ?? 'User') ?></span>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end px-0 text-center">
                                    <li><a class="dropdown-item" href="edit_profile.php"><i class="bi bi-person-fill"></i> Edit Profile</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-chat-dots-fill"></i> Messages</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill"></i> Settings</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                                </ul>
                            </div>
                            <?php else: ?>
                            <div class="d-flex">
                                <a href="login.php" class="btn btn-outline-primary mx-2 fw-bold">Login</a>
                                <a href="form.php" class="btn btn-outline-primary mx-2 fw-bold">Register</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- Navbar End -->
            <?php
                }

                // =================== HERO SECTION ===================
                public static function site_section() {
            ?>
            <section class="hover-section">
                <div class="container-fluid">
                    <div class="col-12 bg-dark-subtle rounded py-5">  
                        <div class="container text-center">
                            <h1 class="display-4 fw-bold mb-4">Share Your Ideas Around The World!</h1>
                            <p class="lead mb-5 display-6 fw-bold">Your mind is a garden, what you plant grows.</p>
                            <div class="md-2">
                                <a href="my_blog.php" class="btn btn-outline-light btn-lg px-4">Thought</a>
                                <a href="form.php" class="btn btn-outline-primary btn-lg px-4">Write</a>
                                <a href="form.php" class="btn btn-outline-light btn-lg px-4">Explore Here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                }
// =================== NAVBAR SECTION ===================


// =================== POSTS SECTION ===================
    public static function site_posts() {
    global $connection;

    // =======================[START: Handle Search Query]=======================
    $search = '';
    if (isset($_GET['search_post'])) {
        $search = trim($connection->real_escape_string($_GET['search_post']));
    }
    // =======================[END: Handle Search Query]=========================

    // =======================[START: Handle Pagination]=========================
    $limit = 3; // Posts per page
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    // =======================[END: Handle Pagination]===========================

    // =======================[START: Fetch Posts Query]=========================
    $where = "WHERE post_status = 'Active'"; // Only show active posts
    if (!empty($search)) {
        $where .= " AND (post_title LIKE '%$search%' OR post_summary LIKE '%$search%')";
    }

    // Count total rows for pagination
    $countQuery = "SELECT COUNT(*) AS total FROM post $where";
    $countResult = $connection->query($countQuery);
    $totalRows = ($countResult && $countResult->num_rows > 0) ? (int) $countResult->fetch_assoc()['total'] : 0;
    $totalPages = ceil($totalRows / $limit);

    // Main fetch query
    $query = "SELECT * FROM post $where ORDER BY created_at DESC LIMIT 5";
    $result = $connection->query($query);
    // =======================[END: Fetch Posts Query]===========================

    ?>
    <!-- =======================[START: Post Container HTML]======================= -->
    <div class="container my-5" id="posts">
        <div class="row">
            <!-- =======================[START: Main Content Area]======================= -->
            <div class="col-lg-9">
                <!-- Search Box -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="card-title mb-0">Posts</h2>
                            <form class="d-flex col-md-4" method="GET" action="">
                                <input class="form-control me-2" name="search_post" type="search" placeholder="Search Post" value="<?= htmlspecialchars($search) ?>" />
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Posts List -->
                <div class="row g-4">
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($post = $result->fetch_assoc()): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <!-- Featured Image -->
                                    
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
                                        <a href="view_post.php?post_id=<?= $post['post_id'] ?>" class="btn btn-primary">Read More</a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <!-- No Posts Found -->
                        <div class="col-12">
                            <div class="alert alert-warning">No posts found.</div>
                        </div>
                    <?php endif; ?>
                </div>
<!-- // =================== POSTS SECTION =================== -->

<!-- =======================[START: Pagination Controls]======================= -->

                <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
                
<!-- =======================[END: Pagination Controls]========================= -->


            </div>
   
                        
<!-- START: Display Active Categories Sidebar -->
                        <div class="col-lg-3">
    <h4 class="mb-4">Categories</h4>
    <ul class="list-group">
        <?php
        // START: Fetch categories with one associated post image
        $sql = "
            SELECT 
                c.category_id, 
                c.category_title, 
                c.category_description, 
                pa.post_attachment_path
            FROM category c
            LEFT JOIN post_category pc ON c.category_id = pc.category_id
            LEFT JOIN post p ON pc.post_id = p.post_id
            LEFT JOIN post_attachment pa ON p.post_id = pa.post_id
            WHERE c.category_status = 'Active'
            GROUP BY c.category_id
            ORDER BY c.category_title
        ";

        $cat_result = $connection->query($sql);

        if ($cat_result && $cat_result->num_rows > 0):
            while ($cat = $cat_result->fetch_assoc()):
        ?>
        <li class="list-group-item">
            <a href="category_post.php?category_id=<?= $cat['category_id'] ?>">
                <?= htmlspecialchars($cat['category_title']) ?>
            </a><br>
            <small><?= htmlspecialchars($cat['category_description']) ?></small>
            <?php if (!empty($cat['attachment_file'])): ?>
                <div class="mt-2">
                    <img src="<?= htmlspecialchars($cat['attachment_file']) ?>" alt="Category Image" class="img-fluid" style="max-height: 100px;">
                </div>
            <?php endif; ?>
        </li>
        <?php
            endwhile;
        else:
        ?>
        <li class="list-group-item">No active categories found.</li>
        <?php endif; ?>
        <!-- END: Fetch categories with one post image -->
    </ul>
    </div>
<!-- END: Display Active Categories Sidebar with Post Image -->


                    
                    
                </div>
            </div>
            <?php
                }



 // =================== CONTACT US SECTION ===================
                    public static function site_contact_us() {
                ?>
                <div class="container-fluid bg-warning-subtle py-3" id="about">
                    <h1 class="text-center text-white mb-0">Contact Us</h1>
                </div>

                <div class="container my-5">
                    <form class="row g-4 needs-validation" novalidate>
                        <!-- Personal Info -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Form fields for personal info -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Details -->
                        <div class="col-lg-6">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Contact Details</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Form fields for contact details -->
                                </div>
                            </div>
                        </div>
                        
                        <!-- Feedback Section -->
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-light">
                                    <h5 class="mb-0">Your Message</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="helpTextarea" class="form-label">Feedback</label>
                                        <textarea class="form-control" id="helpTextarea" rows="5"></textarea>
                                        <div class="form-text">We wait for your positive feedback</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Buttons -->
                        <div class="col-12 text-center">
                            <a href="contact_us.php" class="btn btn-primary px-5 py-2">Submit</a>
                            <button class="btn btn-outline-secondary px-5 py-2 ms-3" type="reset">Reset Form</button>
                        </div>
                    </form>
                </div>
                <?php
                    }
// =================== CONTACT US SECTION ===================



// =================== FOOTER SECTION ===================
                    public static function site_footer() {
                ?>
                <footer class="bg-dark text-white py-4 text-center">
                    <div class="container">
                        <div class="row " >
                            <!-- Social Links -->
                            <div class="col-md-4 mb-4 ">

                                <h5 class="fw-bold">Connect With Us</h5>
                                <div class="social-icons d-flex flex-column">
                                    <a href="https://www.facebook.com/rajagovindkolhi" class="social-link facebook mb-2"><i class="fab fa-facebook-f me-2"></i>Facebook</a>
                                    <a href="https://twitter.com/rajagovindkolhi" class="social-link twitter mb-2"><i class="fab fa-twitter me-2"></i>Twitter</a>
                                    <a href="https://www.instagram.com/rajagovindkolhi/" class="social-link instagram mb-2"><i class="fab fa-instagram me-2"></i>Instagram</a>
                                    <a href="https://www.linkedin.com/in/rajagovind-kolhi-9ab4b1202/" class="social-link linkedin mb-2"><i class="fab fa-linkedin-in me-2"></i>LinkedIn</a>
                                </div>
                            </div>
                            
                            <!-- Quick Links -->
                            <div class="col-md-2 mb-4 ">
                                <h6 class="fw-bold mb-3">Quick Links</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="main.php" class="text-white text-decoration-none">Home</a></li>
                                    <li class="mb-2"><a href="posts.php" class="text-white text-decoration-none">Posts</a></li>
                                    <li class="mb-2"><a href="my_blog.php" class="text-white text-decoration-none">Blog</a></li>
                                    <li class="mb-2"><a href="contact_us.php" class="text-white text-decoration-none">Contact</a></li>
                                    <li class="mb-2"><a href="#about" class="text-white text-decoration-none">About</a></li>
                                </ul>
                            </div>
                            
                            <!-- Newsletter -->
                            <div class="col-md-4 mb-4">
                                <h6 class="fw-bold">Newsletter</h6>
                                <p>Subscribe to stay updated</p>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                    <button class="btn btn-primary" type="button">Subscribe</button>
                                </div>
                            </div>
                            
                            <!-- Feedback Form -->
                            <div class="col-md-2 mb-4">
                                <h6 class="fw-bold">Feedback</h6>
                                <?php
                                $user_id = $_SESSION['user_id'] ?? null;
                                // session_start();
                                if (isset($_SESSION['feedback_success'])) {
                                    echo '<div class="alert alert-success">' . $_SESSION['feedback_success'] . '</div>';
                                    unset($_SESSION['feedback_success']);
                                }
                                if (isset($_SESSION['feedback_error'])) {
                                    echo '<div class="alert alert-danger">' . $_SESSION['feedback_error'] . '</div>';
                                    unset($_SESSION['feedback_error']);
                                }
                                ?>

                            <form method="post" action="feedback_send.php">
                            <input type="text" name="name" class="form-control mb-2" placeholder="Your Name" required>
                            <input type="email" name="email" class="form-control mb-2" placeholder="Your Email" required>
                            <textarea class="form-control mb-2" name="message" rows="3" placeholder="Your feedback" required></textarea>
                            
                            <button type="submit" class="btn btn-warning btn-sm">Send</button>
                            </form>

                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="text-center">
                            <p class="mb-0">&copy; 2025 Mind Write. All rights reserved.</p>
                        </div>
                    </div>
                </footer>
                <?php
                    }

                    // =================== FOOTER SCRIPTS ===================
                    public static function footer_scripts() {
                ?>
                <!-- Bootstrap JS -->
                <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- Custom JS -->
                <script>
                    // Enable Bootstrap tooltips
                    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                        return new bootstrap.Tooltip(tooltipTriggerEl)
                    });
                    
                    // Form validation
                    (function () {
                        'use strict'
                        var forms = document.querySelectorAll('.needs-validation')
                        Array.prototype.slice.call(forms)
                            .forEach(function (form) {
                                form.addEventListener('submit', function (event) {
                                    if (!form.checkValidity()) {
                                        event.preventDefault()
                                        event.stopPropagation()
                                    }
                                    form.classList.add('was-validated')
                                }, false)
                            })
                    })()
                </script>
                </body>
                </html>
                <?php
                    }
                }
// =================== FOOTER SECTION ===================
