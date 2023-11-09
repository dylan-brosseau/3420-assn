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
                <p>Please provide your username and/or email address to request a password reset.</p> <!-- Informational message for users -->

                <div class="forgotinfo"> <!-- Container for username/email input and submit button -->
                   <!-- <label for="usernameOrEmail">Username or Email:</label> -->
                    <input type="text" id="usernameOrEmail" name="usernameOrEmail" placeholder="Username or Email" required> <!-- Input field for entering username or email -->

                    <!-- Submit Button -->
                    <div>
                        <button type="submit">Change Password</button> <!-- Button to submit the password change request -->
                    </div>
                </div>
            </div>
        </form>   
    </main>
</body>
</html>
