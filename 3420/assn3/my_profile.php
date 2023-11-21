?php

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

<body class="myprofile">
    <main>
        <a href="index.php">Back to Main Page</a>
        <div class="myprofilepage">
            <h1>My Profile</h1>

            <!-- Form for editing user profile -->
            <form method="post" action="my_profile.php">
                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username"  value="<?php echo htmlspecialchars($result['username']); ?>" readonly>
                </div>
                <div>
                    <label for="full-name">Full Name:</label>
                    <input type="text" id="full-name" name="full_name" value="<?php echo htmlspecialchars($result['name']); ?>" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($result['email']); ?>" required>
                </div>
                <button type="submit" name="submit">Save Profile</button>
            </form>
        </div>
    </main>
</body>
</html>
