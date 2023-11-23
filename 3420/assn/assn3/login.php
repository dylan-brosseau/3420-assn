<?php
require './includes/library.php';


session_start();

//if the login page is opened while the user is logged in, session is cleared and user is logged out
if(isset($_SESSION['username'])){
    // Unset all of the session variables.
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    header("Location: login.php"); 
    exit();
}


$pdo = connectDB();
$errors = array();

if(isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
}
else{
    $username  = $_POST['username'] ?? "";
}
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
            if ($remember_me) {
                // Encrypt the password before saving in cookies
                setcookie("username", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
                // The encrypted password should be saved here
            }
            session_start();
            $_SESSION['username'] = $username;
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
            <a href="index.php">Go to Main Page</a> <!-- Link to the main page -->
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
                    <label><input type="checkbox" id="remember_me" name="remember_me" <?php if($remember_me) echo "checked"; ?>> Remember Me</label> <!-- Checkbox for "Remember Me" option -->
                </div>
                <div><a href="forgot_password.php">Forgot Password?</a> <!-- Link to the Forgot Password page --></div>
                <!-- Register Link -->
                <div class='loginlinks'> <!-- Container for the "Register" link -->
                    <p>Don't have an account?<a href="register.php"> Register</a></p> <!-- Link to the Registration page -->
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
