<?php
session_start();
require './includes/library.php';
$pdo = connectDB();
$is_logged_in = isset($_SESSION['username']) ? true : false;

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM assn_user_lists WHERE id = ?");
$stmt->execute([$id]);
$list_details = $stmt->fetchAll();

//get entries from selected list
$stmt2 = $pdo->prepare("SELECT * FROM assn_list_entries WHERE table_title = ? AND username = ?");
$stmt2->execute([$list_details[0]['title'], $_SESSION['username']]);
$list_entries = $stmt2->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>Public Lists View</title> <!-- Setting the page title -->
</head>
<body class="public_list_page">
   
    
    <h2 id="list_page_header">Public Lists</h2> <!-- Heading for the Public Lists page -->
        <!-- Include any header content or navigation links here -->
     

    <main>
        
        <div class="index_container"> <!-- Container for displaying public lists -->
        <ul class="bucket_list"> <!-- Unordered list for displaying list items -->
                <!-- List Item 1 -->
                <h1 class="page_list_title"><?= $list_details[0]['title']?></h1> <!-- Heading for the list title -->
                <p><strong>List Description:</strong></p> <!-- Displaying a description of the list -->
            <p><?= $list_details[0]['description']?></p>
                <?php 

                if(!$list_entries) {
                    echo "This list has no entries yet."; 
                } else {
                    foreach($list_entries as $entry) {
                        echo "<li>";
                        echo "<p><strong>Entry:</strong> " . $entry["entry_name"]. "</p>";
                        echo "<p><strong>Description:</strong> " . $entry["description"]. "</p>";
                        echo "<p><strong>Status:</strong> " . $entry["status"]. "</p>";
                        echo "<p><a href='view_item.php?param={$entry['id']}'>View Details</a>";
                        echo "</li>";
                    }
                }

                ?>
               
            </ul>  
           
        
               
        </div>
    </main>

    
</body>
</html>