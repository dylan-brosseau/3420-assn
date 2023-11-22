<?php

session_start();
require './includes/library.php';
$pdo = connectDB();

// Get the user's data from the database using a SELECT query
$sql = "SELECT * FROM assn_accounts WHERE username = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['username']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle the form submission and update the user's data using an UPDATE query
if (isset($_POST['submit'])) {
  // Get the form data
  $name = $_POST['full_name'];
  $email = $_POST['email'];

 
 // Validate the form data
 $errors = [];

 // Validate Full Name
 if (empty($name)) {
   $errors['name'] = "Full Name is required";
 } elseif (!preg_match("/^[a-zA-Z ]+$/", $name)) {
   $errors['name'] = "Invalid Full Name format";
 }

 // Validate Email
 if (empty($email)) {
   $errors['email'] = "Email is required";
 } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   $errors['email'] = "Invalid email format";
 }

 // Check for validation errors
 if (empty($errors)) {
   // Update the user's data in the database
   $sql = "UPDATE assn_account SET name = ?, email = ? WHERE username = ?";
   $stmt = $pdo->prepare($sql);
   $result = $stmt->execute([$name, $email, $_SESSION['username']]);

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
        <a href="index.html">Back to Main Page</a> <!-- Link to return to the main page -->
        <div class="myprofilepage"> <!-- Stylish container for the user profile details -->
            <h1>My Profile</h1> <!-- Heading for the user profile section -->
            <!-- Username -->
            <div>
                <input type="text" id="username" name="username" placeholder="JohnDoe123" required readonly>
                <!-- Input field for username, pre-filled and read-only as it's obtained from registration -->
            </div>
            <!-- Full Name -->
            <div>
                <input type="text" id="full-name" name="full-name" placeholder="John Doe" required readonly>
                <!-- Input field for full name, pre-filled and read-only as it's obtained from registration -->
            </div>
            <!-- Email -->
            <div>
                <input type="email" id="email" name="email" placeholder="john@example.com" required readonly>
                <!-- Input field for email, pre-filled and read-only as it's obtained from registration -->
            </div>
            <!-- Date of Birth -->
            <div>
                <input type="date" id="dob" name="dob">
                <!-- Input field for date of birth -->
            </div>
            <!-- Location -->
            <div>
                <input type="text" id="location" name="location" placeholder="Enter your location">
                <!-- Input field for the user's location -->
            </div>
            <!-- Bio -->
            <div>
                <textarea id="bio" name="bio" placeholder="Write a brief bio about yourself"></textarea>
                <!-- Text area for the user to write a brief bio about themselves -->
            </div>
            <!-- Interests -->
            <div>
                <input type="text" id="interests" name="interests" placeholder="Enter your interests">
                <!-- Input field for the user's interests -->
            </div>
            <!-- Social Media Links -->
            <div>
                <input type="url" id="facebook" name="facebook" placeholder="Enter your Facebook URL">
                <input type="url" id="twitter" name="twitter" placeholder="Enter your Twitter URL">
                <input type="url" id="instagram" name="instagram" placeholder="Enter your Instagram URL">
                <!-- Input fields for social media links (Facebook, Twitter, and Instagram) -->
            </div>
            <!-- Education -->
            <div>
                <input type="text" id="education" name="education" placeholder="Enter your education">
                <!-- Input field for the user's education -->
            </div>
            <!-- Occupation -->
            <div>
                <input type="text" id="occupation" name="occupation" placeholder="Enter your occupation">
                <!-- Input field for the user's occupation -->
            </div>
            <button type="submit">Save Profile</button> <!-- Button to save user profile changes -->
        </div>
    </main>
</body>
</html>
