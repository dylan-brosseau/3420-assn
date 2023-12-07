<?php
session_start();
require './includes/library.php';
$pdo = connectDB();
$is_logged_in = isset($_SESSION['username']) ? true : false;

// Redirect to login page if not logged in
if (!$is_logged_in) {
    header("Location: login.php");
    exit();
}

// Get item ID from query string
$item_id = $_GET['param'] ?? null;

// If item_id is not set, redirect to index page
if (!$item_id) {
    header("Location: index.php");
    exit();
}

// Query to get item
$stmt = $pdo->prepare("SELECT * FROM assn_list_entries WHERE id = ?");
$stmt->execute([$item_id]);
$entry = $stmt->fetch();

// Check if the item exists and if the user owns the item
if (!$entry || $entry['username'] != $_SESSION['username']) {
    header("Location: index.php");
    exit();
}

// Delete the item
$deleteStmt = $pdo->prepare("DELETE FROM assn_list_entries WHERE id = ?");
$deleteStmt->execute([$item_id]);

// Redirect to index page after deletion
header("Location: index.php");
exit();
?>
