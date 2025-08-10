<!-- form start    -->

      <?php
      // require_once("serverside_validation.php");
      require_once ("General.php");
      require_once ("reg_process.php");

      General::site_header();

      General::site_navbar(); 
      ?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Registraion Form </title>
    <style>
      span{
        color: red;
      }
      #btn{
        background-color: skyblue;
        color: black;
        border-radius: 4px;
        margin-left: 2%;
      }
    </style>
  </head>
  <body style="background-color: floralwhite;">
  <center>
      <h1 style="color: black ; background-color: ghostwhite;">User Registraion Form</h1>
      <hr/>

    <p><?php echo $_REQUEST['message']??''; ?></p>

      <fieldset>
        <legend style="color:red;">Reg Form</legend>
        <form action="dummy.php" method="POST" enctype="multipart/form-data" onsubmit="return validation()">
          <table border="0" cellpadding="10">
            <tr>
              <th><label>First Name : <span>*</span></label></th>
              <td>
                <input id="first_name" type="text" name="first_name" value="<?= $first_name??""; ?>">
                <span id="first_name_msg"><?= $first_name_msg??""; ?></span>
              </td>
            </tr>
            <tr>
              <th><label>Last Name : <span>*</span></label></th>
              <td>
                <input id="last_name" type="text" name="last_name" value="<?= $last_name??""; ?>">
                <span id="last_name_msg"><?= $last_name_msg??""; ?></span>
              </td>
            </tr>
            <tr>
              <th><label for="email">Email : <span>*</span></label></th>
              <td>
                <input id="email" type="email" name="email" value="<?= $email??""; ?>">
                <span id="email_msg" style="color: red;" ><?= $email_msg??""; ?></span>
              </td>
            </tr>

            <tr>
  <!--  pass-->
              <th><label>Password : <span>*</span></label></th>
              <td>
                <input id="password" type="password" name="password" value="<?= $password??""; ?>">
                <span id="password_msg"><?= $password_msg??""; ?></span>
              </td>
            </tr>
  <!--  date-->
            <tr>
              <th><label>Date of Birth : <span>*</span></label></th>
              <td>
                <input id="date_of_birth" type="date" name="date_of_birth" value="<?= $date_of_birth??""; ?>">
                <span id="date_of_birth_msg"><?= $date_of_birth_msg??""; ?></span>
              </td>
            </tr>
  <!-- address -->
            <tr>
              <th><label>Address: <span>*</span></label></th>
              <td>
                <input id="address" type="text" name="address" value="<?= $address??""; ?>">
                <span id="address_msg"><?= $address_msg??""; ?></span>
              </td>
            </tr>
            <tr>
              <th><label>Gender : <span>*</span></label></th>
              <td>
                <input id="gender" type="radio" name="gender" value="Male" <?php echo(isset($gender) && $gender == 'Male')?"checked":"";  ?> >Male
                <input id="gender" type="radio" name="gender" value="Female" <?php echo(isset($gender) && $gender == 'Female')?"checked":"";   ?> >Female
                <span id="gender_msg"><?= $gender_msg??""; ?></span>
              </td>
            </tr>

            <tr>
              <th><label>Upload Profile Picture : <span>*</span></label></th>
              <td>
                <input id="profile_pic" type="file" name="profile_pic" value="<?= $profile_pic??""; ?>">
                <span id="profile_pic_msg"><?= $profile_pic_msg??""; ?></span>
              </td>
            </tr>
            
            
            <tr>
              <td align="center" colspan="3">
                <input type="submit" name="submit" value="Register">
                <input type="reset" name="Reset" value="Cancel">
                 <a href="login.php" id="btn" class="text-decoration-none btn btn-warning ">Login Here</a>
              </td>
            </tr>
          </table>
        </form>
      </fieldset>
    
  </center>
  </body>
  </html>
  
<script src="client_side_validation.js"></script>

<script>
  $(document).ready(function () {
    $('#email').on('blur', function () {
      var email = $(this).val().trim();

      if (email.length > 0) {
        $.ajax({
          url: 'check_email.php',
          type: 'POST',
          data: { email: email },
          success: function (response) {
            if (response.trim() === 'exists') {
              $('#email_msg').text('This email is already registered. Try another.');
              $('#submit_btn').prop('disabled', true);
            } else {
              $('#email_msg').text('');
              $('#submit_btn').prop('disabled', false);
            }
          },
          error: function () {
            $('#email_msg').text('Server error. Please try again.');
          }
        });
      }
    });
  });
</script>


  
  <?php
    General::site_footer();
    // General::site_contact_us();

    // Display footer scripts
    General::footer_scripts();

// <!-- database work  -->
    

    


?>
