            <?php
// =================== START PDF Download Script ===================
            session_start();

            if (!isset($_SESSION['pdf_path']) || !file_exists($_SESSION['pdf_path'])) {
                // No PDF found, redirect to login with message
                $_SESSION['message'] = "PDF not found.";
                $_SESSION['color'] = "red";
                header("Location: login.php");
                exit();
            }

            $pdf_path = $_SESSION['pdf_path'];

            // Clear pdf_path from session after use
            unset($_SESSION['pdf_path']);

            // Send headers to force download PDF
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($pdf_path) . '"');
            header('Content-Length: ' . filesize($pdf_path));

            // Read and output file content
            readfile($pdf_path);

            // Optionally delete the PDF after download to keep server clean
            unlink($pdf_path);

            // After download, redirect user to login page with success message using JavaScript
            echo <<<HTML
            <script>
                setTimeout(function(){
                    window.location.href = 'login.php';
                }, 1000); // redirect after 1 second
            </script>
            HTML;

            exit();
// =================== END PDF Download Script ===================
            ?>
