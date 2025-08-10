<!-- login funtion -->
        <?php
        // functions.php

        function displayUserDropdown() {
            // Check if user is logged in
            $isLoggedIn = isset($_SESSION['users']);
            
            if ($isLoggedIn) {
                $user = $_SESSION['users'];
                $fullName = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
                $profileImage = $user['user_image'] ?? 'default_profile.jpg'; // Fallback image
                
                // Return the dropdown HTML
                return <<<HTML
                <div class="dropdown auth-buttons d-flex justify-content-center mx-2">
                    <div class="user-info d-flex align-items-center dropdown-toggle" 
                         data-bs-toggle="dropdown" 
                         style="cursor:pointer;">
                        <img src="{$profileImage}" 
                             alt="User Image" 
                             style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">
                        <span class="fw-bold">{$fullName}</span>
                    </div>
                    
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="edit_profile.php"><i class="bi bi-person-fill"></i> Edit Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-chat-dots-fill"></i> Messages</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </div>
        HTML;
            } else {
                // Return login/register buttons
                return <<<HTML
                <div class="auth-buttons d-flex justify-content-center mx-2">
                    <a href="login.php" class="btn btn-outline-primary mx-2 fw-bold">Login</a>
                    <a href="form.php" class="btn btn-outline-primary mx-2 fw-bold">Register</a>
                </div>
        HTML;
            }
        }
        ?>
<!-- login funtion -->
        