function validation() {
    var flag = true;

    /*---------------------Pattern Definitions---------------------------*/
    var alpha_pattern = /^[A-Z]{1}[a-z]{2,}$/;
    var email_pattern = /^[a-z]+\d*[@]{1}[a-z]+[.]{1}(com|net|org){1}$/;
    var password_pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    var date_of_birth_pattern = /^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/;

    /*------------------Target Input Values-----------------------*/
    var first_name = document.querySelector("#first_name").value.trim();
    var last_name = document.querySelector("#last_name").value.trim();
    var email = document.querySelector("#email").value.trim();
    var password = document.querySelector("#password").value;
    var date_of_birth = document.querySelector("#date_of_birth").value;
    var address = document.querySelector("#address").value.trim();
    var gender = document.querySelector("input[name='gender']:checked");
    var profile_pic = document.querySelector("#profile_pic").files[0];

    /*----------------Error Msg Span----------------------*/
    var first_name_msg = document.querySelector("#first_name_msg");
    var last_name_msg = document.querySelector("#last_name_msg");
    var email_msg = document.querySelector("#email_msg");
    var password_msg = document.querySelector("#password_msg");
    var date_of_birth_msg = document.querySelector("#date_of_birth_msg");
    var address_msg = document.querySelector("#address_msg");
    var gender_msg = document.querySelector("#gender_msg");
    var profile_pic_msg = document.querySelector("#profile_pic_msg");

    /*------------------First Name Validation----------------------*/
    if (first_name === "") {
        flag = false;
        first_name_msg.innerHTML = "Field Required";
    } else {
        first_name_msg.innerHTML = "";
        if (!alpha_pattern.test(first_name)) {
            flag = false;
            first_name_msg.innerHTML = "Pattern Must Be Like eg: Ahmed";
        }
    }

    /*------------------Last Name Validation----------------------*/
    if (last_name === "") {
        flag = false;
        last_name_msg.innerHTML = "Field Required";
    } else {
        last_name_msg.innerHTML = "";
        if (!alpha_pattern.test(last_name)) {
            flag = false;
            last_name_msg.innerHTML = "Pattern Must Be Like eg: Khan";
        }
    }

    /*------------------Email Validation----------------------*/
    if (email === "") {
        flag = false;
        email_msg.innerHTML = "Field Required";
    } else {
        email_msg.innerHTML = "";
        if (!email_pattern.test(email)) {
            flag = false;
            email_msg.innerHTML = "Pattern Must Be Like eg: example@gmail.com";
        }
    }

    /*------------------Password Validation----------------------*/
    if (password === "") {
        flag = false;
        password_msg.innerHTML = "Field Required";
    } else {
        password_msg.innerHTML = "";
        if (!password_pattern.test(password)) {
            flag = false;
            password_msg.innerHTML = "Must contain at least 8 characters with 1 uppercase, 1 lowercase, 1 number, and 1 special character";
        }
    }

    /*------------------Date of Birth Validation----------------------*/
    if (date_of_birth === "") {
        flag = false;
        date_of_birth_msg.innerHTML = "Field Required";
    } else {
        date_of_birth_msg.innerHTML = "";
        
        // Check format first
        if (!date_of_birth_pattern.test(date_of_birth)) {
            flag = false;
            date_of_birth_msg.innerHTML = "Invalid date format. Use YYYY-MM-DD";
        } else {
            // Check if date is valid
            var date_parts = date_of_birth.split('-');
            var year = parseInt(date_parts[0]);
            var month = parseInt(date_parts[1]);
            var day = parseInt(date_parts[2]);
            
            var date = new Date(year, month - 1, day);
            if (date.getFullYear() !== year || (date.getMonth() + 1) !== month || date.getDate() !== day) {
                flag = false;
                date_of_birth_msg.innerHTML = "Invalid date (e.g., February 30 doesn't exist)";
            } else if (date >= new Date()) {
                flag = false;
                date_of_birth_msg.innerHTML = "Date must be in the past";
            }
        }
    }

    /*------------------Address Validation----------------------*/
    if (address === "") {
        flag = false;
        address_msg.innerHTML = "Field Required";
    } else {
        address_msg.innerHTML = "";
    }

    /*------------------Gender Validation----------------------*/
    if (!gender) {
        flag = false;
        gender_msg.innerHTML = "Field Required";
    } else {
        gender_msg.innerHTML = "";
    }

    /*------------------Profile Picture Validation----------------------*/
    if (!profile_pic) {
        flag = false;
        profile_pic_msg.innerHTML = "Field Required";
    } else {
        profile_pic_msg.innerHTML = "";
        
        // Check file type
        var validExtensions = ['jpg', 'jpeg', 'png'];
        var fileExt = profile_pic.name.split('.').pop().toLowerCase();
        
        if (!validExtensions.includes(fileExt)) {
            flag = false;
            profile_pic_msg.innerHTML = "Only JPG, JPEG, PNG files allowed";
        }
        
        // Check file size (5MB max)
        if (profile_pic.size > 5 * 1024 * 1024) {
            flag = false;
            profile_pic_msg.innerHTML = "File size must be less than 5MB";
        }
    }

    return flag;
}



function checkEmailAvailability() {
    var email = document.querySelector("#email").value.trim();
    var email_msg = document.querySelector("#email_msg");
    
    if (email === "" || !/^[a-z]+\d*[@]{1}[a-z]+[.]{1}(com|net|org){1}$/.test(email)) {
        return; // Don't check if email is empty or invalid
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "check_email.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.exists) {
                email_msg.innerHTML = "Email already registered. Please try other email.";
                document.querySelector("#email").focus();
            } else {
                email_msg.innerHTML = "";
            }
        }
    };
    
    xhr.send("email=" + encodeURIComponent(email));
}

// Add event listener for email field
document.querySelector("#email").addEventListener("blur", checkEmailAvailability);


