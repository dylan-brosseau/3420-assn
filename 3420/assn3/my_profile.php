<?php
require './includes/library.php';
session_start();
$pdo = connectDB();
$errors = array();

// Get username from session
$username = $_SESSION['username'];

// Fetch user data from the database
$stmt = $pdo->prepare("SELECT * FROM assn_accounts WHERE username = ?");
$stmt->execute([$username]);
$userData = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user data is fetched successfully
if (!$userData) {
    // Handle the case where user data retrieval fails, redirect or show an error message
    // For example, you can redirect to an error page:
    header("Location: error_page.php");
    exit();
}
?>
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
            <h1>My Profile</h1> <!-- Heading for the user profile section -->
            
           <!-- Username -->
            <div>
                <input type="text" id="username" name="username" value="<?= $userData['username'] ?>" readonly>
            </div>
            <!-- Full Name -->
            <div>
                <input type="text" id="full-name" name="full-name" value="<?= $userData['name'] ?>" readonly>
            </div>
            <!-- Email -->
            <div>
                <input type="email" id="email" name="email" value="<?= $userData['email'] ?>" readonly>
            </div>
            <!-- Date of Birth -->
            <div>
                <input type="date" id="dob" name="dob" value="<?= $userData['dob'] ?>">
            </div>
            <!-- Location -->
            <div>
                <input type="text" id="location" name="location" value="<?= $userData['location'] ?>">
            </div>
            <!-- Bio -->
            <div>
                <textarea id="bio" name="bio"><?= $userData['bio'] ?></textarea>
            </div>
            <!-- Interests -->
            <div>
                <input type="text" id="interests" name="interests" value="<?= $userData['interests'] ?>">
            </div>
            <!-- Social Media Links -->
            <div>
                <input type="url" id="facebook" name="facebook" value="<?= $userData['facebook'] ?>" placeholder="Enter your Facebook URL">
                <input type="url" id="twitter" name="twitter" value="<?= $userData['twitter'] ?>" placeholder="Enter your Twitter URL">
                <input type="url" id="instagram" name="instagram" value="<?= $userData['instagram'] ?>" placeholder="Enter your Instagram URL">
            </div>
            <!-- Education -->
            <div>
                <input type="text" id="education" name="education" value="<?= $userData['education'] ?>">
            </div>
            <!-- Occupation -->
            <div>
                <input type="text" id="occupation" name="occupation" value="<?= $userData['occupation'] ?>">
            </div>
            <button type="submit" name="submit">Save Profile</button> <!-- Button to save user profile changes -->
        </div>
    </main>
</body>
</html>


<?php
// Part 3: Handle form submission to update user data in the database
if (isset($_POST['submit'])) {
    // Update user data in the 'assn_accounts' table
    $updateUserDataQuery = "UPDATE assn_accounts SET dob = ?, location = ?, bio = ?, interests = ?, facebook = ?, twitter = ?, instagram = ?, education = ?, occupation = ? WHERE username = ?";
    $stmtUpdateUserData = $pdo->prepare($updateUserDataQuery);
    $stmtUpdateUserData->execute([$_POST['dob'], $_POST['location'], $_POST['bio'], $_POST['interests'], $_POST['facebook'], $_POST['twitter'], $_POST['instagram'], $_POST['education'], $_POST['occupation'], $username]);

    header("Location: index.php");
    exit();
}
?>