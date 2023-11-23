<?php

session_start();
require './includes/library.php';
$is_logged_in = isset($_SESSION['username']) ? true : false;

$pdo = connectDB();
$item_id = $_GET['param'];

//query to get item 
$stmt= $pdo->prepare("SELECT * FROM assn_list_entries WHERE id = ?");
$stmt->execute([$item_id]);
$entry = $stmt->fetch();

//check if user owns item
if($entry['username'] != $_SESSION['username']){header("Location: index.php"); exit();}

//delete item
$stmt= $pdo->prepare("DELETE FROM assn_list_entries WHERE id = ?");
$stmt->execute([$item_id]);

header("Location: index.php")

?>