<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('https://i.pinimg.com/originals/0e/e9/67/0ee967a36d0ff13b5f28d73de064d551.jpg');
            background-size: cover;
            background-position: center;
        }
        fieldset {
            color: black;
        }
        form {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.9);
            width: 90%;
            max-width: 400px;
        }
        fieldset {
            border: none;
        }
        legend {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
        label, input, select {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="date"], input[type="email"], input[type="password"], select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="radio"] {
            display: inline-block;
            width: auto;
        }
        button[type="submit"] {
            width: auto;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: white;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    
<?php
include('C:\xampp\htdocs\ALR005\php.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $newpassword = $_POST['newpassword'];
    $reenterpassword = $_POST['reenterpassword'];

    // Verify if the email already exists
    $verify_query = mysqli_query($con, "SELECT email FROM detials WHERE email='$email'");
    
    if ($verify_query) {
        $registered = 1;
    }
    else{
        die(mysqli_error($con));
    }

    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message'>
                <p>This email is already used, try another!</p>
            </div><br>";
        echo "<button class='btn' onclick='javascript:self.history.back()'>Go Back &amp; Try Again</button>";
    } else {

        $insert_query = mysqli_query($con, "INSERT INTO detials (name, dob, email, gender, department, newpassword, reenterpassword) VALUES ('$name', '$dob', '$email', '$gender', '$department', '$newpassword', '$reenterpassword')");
        
        if ($insert_query) {
            $registered = 1;
        }
        else{
            die(my_sql_error($con));
        }
        
        echo "<div class='message'>
                <p>Registration successful!</p>
            </div> <br>";
    }
} else {
?>
    <form action="" method="POST">
        <fieldset>
            <legend>Student Sign-in</legend>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            
            <label for="dob">Date of birth</label>
            <input type="date" id="dob" name="dob" required>
            
            <label for="email">Email id</label>
            <input type="email" id="email" name="email" placeholder="Enter your college email id" required>
            
            <label for="gender">Gender</label>
            <input type="text" id="gender" name="gender" placeholder="Enter your gender" required>

            <label for="department">Department</label>
            <input type="text" id="department" name="department" placeholder="Enter your department" required>
                                
            <label for="newpassword">New password</label>
            <input type="password" id="newpassword" name="newpassword" placeholder="Enter new password" minlength="8" maxlength="15" pattern="[a-zA-Z0-9]+" required>
            
            <label for="reenterpassword">Re-enter your password</label>
            <input type="password" id="reenterpassword" name="reenterpassword" placeholder="Re-enter your password" minlength="8" maxlength="15" pattern="[a-zA-Z0-9]+" required>
            
            <button type="submit" name="submit" value="submit">Submit</button>
        </fieldset>
    </form>
<?php } ?>
</body>
</html>
