<?php 
session_start();
require './includes/library.php';
$is_logged_in = isset($_SESSION['username']) ? true : false;

$pdo = connectDB();
$item_id = $_GET['param'];

$stmt= $pdo->prepare("SELECT * FROM assn_list_entries WHERE id = ?");
$stmt->execute([$item_id]);
$entry = $stmt->fetch();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>View List Item</title> <!-- Setting the page title -->
</head>
<body>
    <?php include './includes/nav.php'?>

   
    <main>
        <div class="paper_container"> <!-- Stylish container for displaying list item details -->
            <h1 id="list_item_page_title">List Item Details</h1> <!-- Heading for list item details -->
            <p><h1>Title:</h1> <?= $entry['entry_name']; ?></p> 
            <p><h1>Description:</h1> <?= $entry['description']; ?></p>
            <p><h1>Rating:</h1> <?= $entry['rating'] ? $entry['rating'] : "N/A"; ?></p>
            <p><h1>Completion Date:</h1> <?= $entry['completion_date'] ? $entry['completion_date'] : "Incomplete"; ?></p> 

            <!-- Displaying additional details about the list item -->
            <p><h1>Proof:</h1> </p> <!-- Displaying proof of completing the list item -->
            <img src="img/tower.png" alt="Eiffel Tower" width="200" height="230" >
            <!-- Displaying an image as proof (in this case, an image of the Eiffel Tower) -->
        </div>       
    </main>
</body>
</html>
