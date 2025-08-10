<!-- email checking -->

        <?php
        require_once("require/database_connection.php");

        header('Content-Type: application/json');

        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            
            $query = "SELECT * FROM user WHERE email = ?";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            echo json_encode(['exists' => mysqli_num_rows($result) > 0]);
            
            mysqli_stmt_close($stmt);
            mysqli_close($connection);
        } else {
            echo json_encode(['exists' => false]);
        }
        ?>
<!-- email checking -->
        