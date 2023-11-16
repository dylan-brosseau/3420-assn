<?php
require './includes/library.php';

$pdo = connectDB();
$errors = array();


$username         = $_POST['username'] ?? "";
$password  = $_POST['password'] ?? null;
$remember_me  = $_POST['remember_me'] ?? null;

if (isset($_POST['submit']))
{
    if(count($errors) === 0)
    {
        $stmt = $pdo->prepare("SELECT password FROM assn_accounts WHERE username = ? ");
        $stmt->execute([$username]);
        $user =  $stmt->fetch();

        if (!$user) {$errors['username'] = true;}
        else if(!password_verify($password, $user['password'])){$errors['password'] = true; }
        else{
            session_start();
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        }      
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> <!-- Including Boxicons for icons -->
    <title>User Login</title> <!-- Setting the page title -->
</head>

<body class="login"> <!-- Assigning a class to the body element for styling -->
    <main>
        <div class="loginhead">
            <a href="index.html">Go to Main Page</a> <!-- Link to the main page -->
        </div>
        <form method="POST"> <!-- Form for user login -->
            <div class="loginpage"> <!-- Stylish container for login form -->
                <h1>Login</h1> <!-- Heading for the login section -->
                <!-- Username -->
                <div class="usernamepassword"> <!-- Container for the username input -->
                    <input type="text" id="username" name="username" placeholder="Username"> <!-- Input field for the username -->
                    <span class="error <?= !isset($errors['username']) ? 'hidden' : '' ?>">That user does not exist.</span>
                    <i class='bx bxs-user'></i> <!-- Icon for the username input -->
                </div>
                <!-- Password -->
                <div class="usernamepassword"> <!-- Container for the password input -->
                    <input type="password" id="password" name="password" placeholder="Password"> <!-- Input field for the password -->
                    <span class="error <?= !isset($errors['password']) ? 'hidden' : '' ?>">That password is incorrect.</span>
                    <i class='bx bxs-lock-alt'></i> <!-- Icon for the password input -->
                </div>
                <!-- Remember Me and Forgot Password Link -->
                <div class="checkboxlogin"> <!-- Container for the "Remember Me" and "Forgot Password" options -->
                    <label><input type="checkbox" id="rememberMe" name="rememberMe"> Remember Me</label> <!-- Checkbox for "Remember Me" option -->
                    <a href="forgot_password.html">Forgot Password?</a> <!-- Link to the Forgot Password page -->
                </div>
                <!-- Register Link -->
                <div class='loginlinks'> <!-- Container for the "Register" link -->
                    <p>Don't have an account?<a href="register.html"> Register</a></p> <!-- Link to the Registration page -->
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="submit">Submit</button> <!-- Button to submit the login form -->
                </div>
            </div>
        </form>
    </main>
</body>
</html>
