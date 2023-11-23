<?php

session_start();
require './includes/library.php';

$pdo = connectDB();
$name = $_POST['name']?? "";
$username = $_POST['username'] ?? "";
$email = $_POST['email'] ?? "";

$password  = $_POST['password'] ?? null;
$n_password  = $_POST['n_password'] ?? null;
$c_password  = $_POST['c_password'] ?? null;


// Get the user's data from the database using a SELECT query
$sql = "SELECT * FROM assn_accounts WHERE username = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['username']]);
$user = $stmt->fetchAll();

// Handle the form submission and update the user's data using an UPDATE query
if (isset($_POST['save_profile'])) {
    // Validate the form data
    $errors = [];
    if (empty($username) || strlen($username) > 20) {
        $errors['username'] = "Username must be between 1 and 20 characters";
    }

    // Validate Full Name
    if (empty($name)) {
        $errors['name'] = "Full Name is required";
    } 
    elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $errors['name'] = "Invalid Full Name format";
    }

    // Validate Email
    if (empty($email)) {
        $errors['email'] = "Email is required";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Check for validation errors
    if (empty($errors)) {
        // Update the user's data in the database
        

        // Update the user's data in the database
        $sql = "UPDATE assn_accounts SET username = ?, name = ?, email = ? WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$username, $name, $email, $_SESSION['username']]);

        // Check the result of the query
        if ($result) {
            // Redirect to the main page
            header("Location: index.php");
            exit();
        } else {
            // Display an error message
            echo "Error: Data update failed.";
        }
    }
}
if (isset($_POST['change_password'])) 
{
    if(!password_verify($password, $user[0]['password'])){$errors['password'] = "Incorrect Password"; }
    else if ($n_password != $c_password) {$errors['password'] = "Passwords do not match";}
    else
    {
        $stmt = $pdo->prepare("UPDATE assn_accounts SET
            password = ? WHERE username = ?");
        $result = $stmt->execute([password_hash($n_password, PASSWORD_DEFAULT), $username]);
        if ($result) {
            // Redirect to the main page
            header("Location: index.php");
            exit();
        } else {
            // Display an error message
            echo "Error: Password change failed.";
        }
    }

    
}

if (isset($_POST['delete_account'])) 
{
    header("Location: delete_account.php"); exit();
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>My Profile</title> <!-- Setting the page title -->
</head>

<body class="myprofile"> <!-- Assigning a class to the body element for styling -->
    <main>
        <a href="index.php">Back to Main Page</a> <!-- Link to return to the main page -->
        <div class="myprofilepage"> <!-- Stylish container for the user profile details -->
            <h1>Edit Profile</h1> <!-- Heading for the user profile section -->
            <form name="edit_profile" method="post">
                <!-- Username -->
                <div>
                    <input type="text" id="username" name="username" value="<?= $user[0]['username']?>" required>
                    <!-- Input field for username, pre-filled and read-only as it's obtained from registration -->
                </div>
                <!-- Full Name -->
                <div>
                    <input type="text" id="name" name="name" value="<?= $user[0]['name']?>" required>
                    <!-- Input field for full name, pre-filled and read-only as it's obtained from registration -->
                </div>
                <!-- Email -->
                <div>
                    <input type="email" id="email" name="email" value="<?= $user[0]['email']?>" required>
                    <!-- Input field for email, pre-filled and read-only as it's obtained from registration -->
                </div>
                <button type="submit" name="save_profile">Save Profile</button> <!-- Button to save user profile changes -->

                <hr>

                <h1>Change Password</h1>
                <div>
                    <label>Enter your current password</label>
                    <input type=password name=password>
                </div>
                
                <div>
                    <label>Enter your new password</label>
                    <input type=password name=n_password>
                </div>
                <div>
                    <label>Confirm your new password</label>
                    <input type=password name=c_password>

                </div>
                <button type="submit" name="change_password">Change Password</button> <!-- Button to save user profile changes -->
                <hr/>
                <button type="submit" name="delete_account">Delete My Account</button>
            </form>

                
        </div>
    </main>
</body>
</html>
