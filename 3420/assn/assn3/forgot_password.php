<?php
require './includes/library.php';

$pdo = connectDB();


$entered = $_POST['entered'] ?? "";
$valid_entry = null;

//initialize user array
$user = array();
$user['email'] = '';
$user['username'] = '';

//var_dump($valid_entry);


if (isset($_POST['submit']))
{

     //query to retrive data if a username was entered
    $stmt = $pdo->prepare("SELECT username, email FROM assn_accounts WHERE username = ? ");
    $stmt->execute([$entered]);
    $using_username =  $stmt->fetch();

        //query to retrive data if an email was entered
    $stmt = $pdo->prepare("SELECT username, email FROM assn_accounts WHERE email = ? ");
    $stmt->execute([$entered]);
    $using_email =  $stmt->fetch();

        // if neither query returned data, display error
    if (!$using_username && !$using_email){ $valid_entry = false;}
        // else assign $user to whichever query wass succesfull
    else
    {
        $user = $using_username ? $using_username : $using_email;
        $valid_entry = true;
    }
    //var_dump($valid_entry);
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file -->

    <title>Forgot Password</title> <!-- Setting the page title -->
</head>

<body class="forgot"> <!-- Setting the class of the body element for styling -->
    <main>
        <a href="login.html">Back to Login Page</a> <!-- Link to go back to the Login Page -->

        <form method="POST"> <!-- Form for submitting the forgot password request -->
            <div class="forgotpasspage"> <!-- Stylish container for forgot password form -->
               
                <h1>Forgot Password</h1> <!-- Heading for the forgot password page -->
                <p>Please provide your username or email address to request a password reset.</p> <!-- Informational message for users -->

                <div class="forgotinfo"> <!-- Container for username/email input and submit button -->
                   <!-- <label for="usernameOrEmail">Username or Email:</label> -->
                    <input type="text" id="entered" name="entered" placeholder="Username or Email" required> <!-- Input field for entering username or email -->

                    
                 <!-- Submit Button -->
                    <div>
                        <span class="error <?= $valid_entry===false && $valid_entry !== null ? '' : 'hidden' ?>">That username or email does not exist</span>
                        <span class="error <?= $valid_entry===true && $valid_entry !== null ? '' : 'hidden' ?>">A reset link has been sent to: <?= $user['email'] ?></span>

                        <button type="submit" name="submit">Change Password</button> <!-- Button to submit the password change request -->
                    </div>

                </div>
            </div>
        </form>   
    </main>
</body>
</html>
