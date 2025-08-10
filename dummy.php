    <?php
// =================== START User Registration Script ===================
    session_start();
    require("require/database_connection.php");

    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");
    require("PHPMailer/src/Exception.php");
    require("fpdf/fpdf.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['submit'])) {
        $first_name     = $_POST['first_name'] ?? '';
        $last_name      = $_POST['last_name'] ?? '';
        $email          = $_POST['email'] ?? '';
        $password       = $_POST['password'] ?? '';
        $dob            = $_POST['date_of_birth'] ?? '';
        $address        = $_POST['address'] ?? '';
        $gender         = $_POST['gender'] ?? '';
        $created_at     = date('Y-m-d H:i:s');
        $flag = true;

        // ======== Simple Validations ==========
        if (!preg_match('/^[A-Z][a-z]{2,}$/', $first_name)) $flag = false;
        if (!preg_match('/^[A-Z][a-z]{2,}$/', $last_name)) $flag = false;
        if (!preg_match('/^[a-z]+\d*@[a-z]+\.(com|net|org)$/', $email)) $flag = false;
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) $flag = false;
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob) || strtotime($dob) >= time()) $flag = false;
        if (empty($address) || empty($gender)) $flag = false;

        // ======== Check Email Exists =========
        $check = mysqli_query($connection, "SELECT * FROM user WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $flag = false;
        }

        // ======== Profile Picture =========
        $targetFile = "";
        if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] === 0) {
            $ext = strtolower(pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png'];
            if (in_array($ext, $allowed) && $_FILES['profile_pic']['size'] <= 5 * 1024 * 1024) {
                $targetFile = "uploads/" . uniqid() . "_" . $_FILES['profile_pic']['name'];
                move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile);
            } else {
                $flag = false;
            }
        } else {
            $flag = false;
        }

        // ======== If Valid, Save Data ========
        if ($flag) {
            // Set default role_id = 2
            $role_id = 2;

            $query = "INSERT INTO user (role_id, first_name, last_name, email, password, date_of_birth, address, gender, user_image, created_at)
                      VALUES ('$role_id', '$first_name', '$last_name', '$email', '$password', '$dob', '$address', '$gender', '$targetFile', '$created_at')";
            if (mysqli_query($connection, $query)) {

                // ======== Generate PDF =========
                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',16);
                $pdf->Cell(0,10,'Registration Details',0,1,'C');
                $pdf->SetFont('Arial','',12);
                $pdf->Ln(5);
                $pdf->Cell(0,10,"Name: $first_name $last_name",0,1);
                $pdf->Cell(0,10,"Email: $email",0,1);
                $pdf->Cell(0,10,"Password: $password",0,1);
                $pdf->Cell(0,10,"DOB: $dob",0,1);
                $pdf->Cell(0,10,"Gender: $gender",0,1);
                $pdf->MultiCell(0,10,"Address: $address",0,1);
                $pdf->Cell(0,10,"Registered At: $created_at",0,1);
                $pdf->Cell(0,10,"Status: Pending Approval",0,1,'C');
                $pdf->Ln(10);
                $pdf->SetFont('Arial','I',10);
                $pdf->MultiCell(0,8,"Note: This is system generated. Account pending approval.",0,'C');
                $pdf_content = $pdf->Output('S');

                // ======== Send Email =========
            try {
                    $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->Port = 587;
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'phpbasic2k25@gmail.com';
                    $mail->Password = 'sffymqljdnupfzjc';
                    $mail->setFrom('phpbasic2k25@gmail.com', 'Mind Write Team');
                    $mail->addAddress($email, $first_name);
                    $mail->Subject = "Account Created - PDF Attached";
                    $mail->isHTML(true);
                    $mail->Body = "Dear $first_name, your account has been created Successfully. See attached PDF.";
                    $mail->addStringAttachment($pdf_content, 'registration.pdf', 'base64', 'application/pdf');
                    $mail->send();
                    
            } catch (Exception $e) {}

                // ======== Show PDF in Browser ========
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="registration.pdf"');
                echo $pdf_content;
                exit;
                
                } else {
                echo "Database error.";
                }
              } else {
             echo "Invalid data or email already exists.";
                }
            } else {
            echo "Invalid Request.";
                }
// =================== END User Registration Script ===================
    ?>
