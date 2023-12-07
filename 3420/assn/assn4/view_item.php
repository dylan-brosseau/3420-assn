<?php 
session_start();
require './includes/library.php';
$is_logged_in = isset($_SESSION['username']) ? true : false;

$pdo = connectDB();

// Use the item ID from the AJAX request
$item_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($item_id) {
    $stmt = $pdo->prepare("SELECT * FROM assn_list_entries WHERE id = ?");
    $stmt->execute([$item_id]);
    $entry = $stmt->fetch();

    if ($entry) {
        // Output the details of the item for the modal
        echo "<h1>Title:</h1> " . htmlspecialchars($entry['entry_name']) . "<br>";
        echo "<h1>Description:</h1> " . htmlspecialchars($entry['description']) . "<br>";
        echo "<h1>Rating:</h1> " . ($entry['rating'] ? htmlspecialchars($entry['rating']) : "N/A") . "<br>";
        echo "<h1>Completion Date:</h1> " . ($entry['completion_date'] ? htmlspecialchars($entry['completion_date']) : "Incomplete") . "<br>";
        
    } else {
        echo "Item not found.";
    }
} else {
    echo "No item ID provided.";
}
?>
