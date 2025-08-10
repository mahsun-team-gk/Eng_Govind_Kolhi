<?php
// ==================== START: Contact Us Page Script ====================
            session_start();
            require_once("function.php");
            require_once("General.php");
            require_once("require/database_connection.php");

            General::site_header();
            General::site_navbar();
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Contact Us</title>
                <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
            </head>
            <body>

            <!-- ==================== START: Contact Us Section ==================== -->
            <div class="container-fluid p-0" id="about">
                <div class="row px-0 mt-2">
                    <div class="col-12">
                        <h1 class="bg-warning-subtle text-center py-2 mb-0">Contact Us</h1>
                    </div>
                </div>
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
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First name</label>
                                        <input type="text" class="form-control" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last name</label>
                                        <input type="text" class="form-control" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" required>
                                        <div class="invalid-feedback">Please enter a valid email.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Contact Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Country</label>
                                        <select class="form-select" required>
                                            <option selected disabled value="">Select Country</option>
                                            <option>Pakistan</option>
                                            <option>USA</option>
                                            <option>Bangladesh</option>
                                            <option>China</option>
                                            <option>Russia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" class="form-control" placeholder="+92 300 1234567">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ==================== START: Feedback Section ==================== -->
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Your Feedback</h5>
                            </div>
                            <div class="card-body">

                                <div id="feedback-msg"></div>

                                <form id="feedbackForm">
                                    <?php if (!isset($_SESSION['user_id'])): ?>
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    <?php endif; ?>

                                    <div class="mb-3">
                                        <label class="form-label">Message</label>
                                        <textarea class="form-control" name="feedback" rows="4" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-warning">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- ==================== END: Feedback Section ==================== -->
                </form>
            </div>
            <!-- ==================== END: Contact Us Section ==================== -->

            <script>
            // ========== START: AJAX FEEDBACK SUBMISSION ==========
            $('#feedbackForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'feedback_send.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#feedback-msg').html(`<div class="alert alert-success">${response}</div>`);
                        $('#feedbackForm')[0].reset();
                    },
                    error: function() {
                        $('#feedback-msg').html(`<div class="alert alert-danger">Something went wrong!</div>`);
                    }
                });
            });
            // ========== END: AJAX FEEDBACK SUBMISSION ==========
            </script>

            <?php
            General::site_footer();
            General::footer_scripts();
            ?>
<!-- ==================== END: Contact Us Page Script ==================== -->
