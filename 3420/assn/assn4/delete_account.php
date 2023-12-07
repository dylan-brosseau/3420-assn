<?php
// delete_account.php

require './includes/library.php';
session_start();
$pdo = connectDB();
$errors = array();

if (isset($_POST['submit'])) {
    // Delete user's lists from the 'assn_user_lists' table
    $deleteListsQuery = "DELETE FROM assn_user_lists WHERE username = :username";
    $stmt = $pdo->prepare($deleteListsQuery);
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();

    // Delete user from the 'assn_accounts' table
    $deleteUserQuery = "DELETE FROM assn_accounts WHERE username = :username";
    $stmt = $pdo->prepare($deleteUserQuery);
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();

    header("Location: login.php");
    exit();
}
?>

<!-- delete_account.php -->
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

        <!-- Assign an id to the form -->
        <form method="post" action="" id="deleteForm">
            <button type="submit" name="submit">Delete Account</button>
        </form>
    </main>

    <!-- Link the external JavaScript file in the js folder -->
    <script defer src="./scripts/confirm_delete.js"></script>
</body>

</html>
