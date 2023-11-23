<?php
session_start();
require './includes/library.php';
$pdo = connectDB();
$is_logged_in = isset($_SESSION['username']) ? true : false;
if (!$is_logged_in){header("Location: login.php"); exit();}

$search = $_POST['search'] ?? "";

$search_results=null;
if (isset($_POST['submit_search']))
{
    //note that since some entries may be on private lists, the username and list names are not shown
    $stmt = $pdo->prepare("SELECT id, entry_name, description FROM assn_list_entries
    WHERE entry_name LIKE ? OR description LIKE ?");
    $search_stmt = "%".$search."%";
    $stmt->execute([$search_stmt, $search_stmt]);
    $search_results = $stmt->fetchAll();

}
if (isset($_POST['submit_lucky']))
{
    //note that since some entries may be on private lists, the username and list names are not shown
    $stmt2 = $pdo->prepare("SELECT id, entry_name, description 
    FROM assn_list_entries ORDER BY RAND() LIMIT 4");
    $stmt2->execute();
    $lucky_results = $stmt2->fetchAll();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>Discover</title> <!-- Setting the page title -->
</head>
<body class="search_page">
   
    <?php include './includes/nav.php'?>


    <div class="parent"> <!-- Parent container for search and lucky sections -->
        <div class="container1">
            <h2>Discover Bucket List Items</h2> <!-- Heading for discovering bucket list items -->
            <form method="post">
            <label for="searchInput">Search:</label> <!-- Label for search input field -->
            <input class="reg_input" type="text" id="searchInput" name="search" placeholder="Enter keywords..."> <!-- Search input field -->
            <button type="submit" name="submit_search">Search</button> <!-- Search button -->
        
            <h2>Search Results</h2> <!-- Heading for displaying search results -->
            <ul>
          <?php 
            if ($search_results)
            {
                $i = 0;
                while (isset($search_results[$i]['entry_name']) && $i < 4 )
                { ?>
                    <li>   
                        <a href="view_item.php?param=<?= $search_results[$i]['id'] ?>">
                            <?= $search_results[$i]['entry_name'] ?>
                        </a>
                    </li>
                    <?php 
                    $i++;
                } 
            } 
            else{echo "No Results";}
            ?>        
            </ul>
        </div>

        <div class="container2">
            <h2>Feeling Lucky?</h2> <!-- Heading for the "Feeling Lucky" section -->
        
            <button type="submit" name="submit_lucky">I'm Feeling Lucky</button> <!-- Button for generating a random suggestion -->
            </form>
            <!-- Display a random suggestion here -->
            <h2>Results</h2>
            <ul>
            <?php 
                
                $i = 0;
                while (isset($lucky_results[$i]['entry_name']) && $i < 4 )
                { ?>
                    <li>   
                        <a href="view_item.php?param=<?= $lucky_results[$i]['id'] ?>">
                            <?= $lucky_results[$i]['entry_name'] ?>
                        </a>
                    </li>
                    <?php 
                    $i++;
                    } 
                ?>        
            </ul><!-- A random suggestion with a link to view details -->
        </div>
    </div>
</body>
</html>
