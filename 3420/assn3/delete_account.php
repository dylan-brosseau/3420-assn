<?php
require './includes/library.php';
// Delete user's data from the database
session_start();
$pdo = connectDB();
$errors = array();

// Get username from session
$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
    // Delete user's lists from the 'assn_user_lists' table
    $deleteListsQuery = "DELETE FROM assn_user_lists WHERE username = :username";
    $stmt = $pdo->prepare($deleteListsQuery);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Delete user from the 'assn_accounts' table
    $deleteUserQuery = "DELETE FROM assn_accounts WHERE username = :username";
    $stmt = $pdo->prepare($deleteUserQuery);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/assn.css" />
    <title>Delete Account</title>
</head>

<body>
    <main>
        <h2>Delete Account</h2>
        <p>Are you sure you want to delete your account? This action cannot be undone.</p>

        <form method="post" action="">
            <button type="submit" name="submit" >Delete Account</button>
        </form>
    </main>
</body>

</html>