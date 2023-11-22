<?php
session_start();
require './includes/library.php';

$pdo = connectDB();

// Check if the user is logged in or not
if (!isset($_SESSION['username'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Check if the item ID is provided in the URL
if (!isset($_GET['id'])) {
    // Redirect to the Main List if ID is not provided
    header("Location: index.php");
    exit();
}

$itemId = $_GET['id'];

// Retrieve the list item data from the database
$sql = "SELECT * FROM assn_list_entries WHERE id = ? AND username = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$itemId, $_SESSION['username']]);
$itemData = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the user owns the list item
if (!$itemData) {
    // Redirect to the Main List if the user doesn't own the item
    header("Location: index.php");
    exit();
}

// Delete the list item data from the database
$sql = "DELETE FROM assn_list_entries WHERE id = ?";
$stmt = $pdo->prepare($sql);
$result = $stmt->execute([$itemId]);

// Check the result of the query
if ($result) {
    // Redirect to the Main List after deleting the data
    header("Location: index.php");
    exit();
} else {
    // Display an error message
    echo "Error: Data deletion failed.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file -->
    <title>Delete List Item</title>
</head>
<body class="deleteitem">
    
    <nav>
        <ul>
            <li>
                <a href="index.php">Back to Main List</a>
            </li>
            <li>
                <a href="my_profile.php">My Profile</a>
            </li>
        </ul>
    </nav>

    <main>
        <div class="deleteitempage">
            <h1>Delete List Item</h1>
            
            <p>Are you sure you want to delete this list item?</p>

            <form method="post" action="delete_item.php">
                <!-- Hidden input to pass the item ID to the server -->
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                
                <button type="submit">Yes, Delete</button>
            </form>

            <a href="index.php">Cancel</a>
        </div>
    </main>
</body>
</html>
