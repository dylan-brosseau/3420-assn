<?php
session_start();
require './includes/library.php';
$is_logged_in = isset($_SESSION['username']) ? true : false;

$pdo = connectDB();
$item_id = $_GET['param'];

// Query to get item
$stmt = $pdo->prepare("SELECT * FROM assn_list_entries WHERE id = ?");
$stmt->execute([$item_id]);
$entry = $stmt->fetch();

// Check if the user owns the item
if ($entry['username'] != $_SESSION['username']) {
    header("Location: index.php");
    exit();
}

// Include the external JavaScript file
echo '<script src="js/confirm_deleteitem.js"></script>';
?>

