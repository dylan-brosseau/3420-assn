<?php
session_start();
require './includes/library.php';
$pdo = connectDB();
$is_logged_in = isset($_SESSION['username']) ? true : false;
if (!$is_logged_in){header("Location: login.php"); exit();}

//get all list titles for the user
$stmt = $pdo->prepare("SELECT title FROM assn_user_lists WHERE username = ? ");
$stmt->execute([$_SESSION['username']]);
$titles =  $stmt->fetchAll();

//$selected_list;
// setting the default selected list to the first list in the table
if (isset($_POST['title_button'])) {
    $selected_list = $_POST['title_button'];
} 
else {
    // If no list was selected, default to the first list
    $selected_list = $titles[0]['title'];
}

// get details from selected list
$stmt2 = $pdo->prepare("SELECT title, description FROM assn_user_lists WHERE title = ? AND username = ?");
$stmt2->execute([$selected_list, $_SESSION['username']]);
$list_details = $stmt2->fetchAll();

//get entries from selected list
$stmt3= $pdo->prepare("SELECT * FROM assn_list_entries WHERE table_title = ? AND username = ?");
$stmt3->execute([$selected_list, $_SESSION['username']]);
$list_entries = $stmt3->fetchAll();

//checking if the selected list has any entries
$list_entries ? $has_entry = true : $has_entry = false;



if (isset($_POST['submit']))
{
    $stmt4 = $pdo->prepare("INSERT INTO assn_list_entries
     (id, table_title, username, entry_name, status, description) 
     VALUES(?,?,?,?,?,?)");
     $stmt4->execute([uniqid('', true), $selected_list, 
     $_SESSION['username'], $_POST['title'], 'incomplete', $_POST['description']]);
     header("Location: {$_SERVER['PHP_SELF']}");
     exit();

}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>Index</title> <!-- Setting the page title -->
</head>
<body class="index_page">
    
    <?php include './includes/nav.php'?>

    <hr> <!-- Horizontal rule to separate sections -->
    
    <div class="index_parent"> <!-- Parent container for the main content -->
        <!--Sidebar-->
        <div class="index_sidebar"> <!-- Sidebar for user lists and profile links -->
            <h2>My Lists</h2> <!-- Heading for user's lists -->
            <ul>
           <form method="post">
                <ul>
                     <?php foreach ($titles as $title) : ?>
                            <li>
                                <button type="submit" name="title_button" value="<?= $title['title'] ?>">
                                <?= $title['title'] ?>
                                </button>
                             </li>
                    <?php endforeach; ?>
                </ul>
            </form>

            </ul>
          
            
            <h2>Me</h2> <!-- Heading for user's profile links -->
            <ul>
                <li><?= $_SESSION['username'] ?> </li> <!-- Displaying the username -->
                <li><a href="my_profile.php">Edit Profile</a></li> <!-- Link to edit user's profile -->
                <li><a href="login.php">Sign out</a></li> <!-- Link to sign out from the account -->
            </ul>
        </div>

        
        <div class="index_container"> <!-- Container for displaying list details -->   
            <h1 class="page_list_title"><?= $list_details[0]['title']?></h1> <!-- Heading for the list title -->
            <p><strong>List Description:</strong></p> <!-- Displaying a description of the list -->
            <p><?= $list_details[0]['description']?></p>
            <!-- Additional details about the list -->
            <br> <!-- Line break for separation -->
            
            <!-- List of Bucket List Items -->
            <ul class="bucket_list"> <!-- Unordered list for displaying list items -->
                <!-- List Item 1 -->
                <?php 
                    if(!$list_entries){echo "This list has no entries yet."; }
                    else
                    {
                        foreach($list_entries as $entry)
                        {
                            echo "<li>";
                            echo "<p><strong>Entry:</strong> " . $entry["entry_name"]. "</p>";
                            echo "<p><strong>Description:</strong> " . $entry["description"]. "</p>";
                            echo "<p><strong>Status:</strong> " . $entry["status"]. "</p>";
                            echo '<p><a href="view_item.php">View Details</a> | <a href="edit_item.php">Edit</a> | <a href="#">Delete</a></p>';
                            echo "</li>";
                        }
                    }
                ?>
               
            </ul>         
        </div>
    
        <div class="index_add"> <!-- Container for adding a new list item -->
            <form class="index_container" name="add_entry" method="POST">
                <h2>Add New Entry</h2> <!-- Heading for adding a new list item -->
                <div>
                    <label for="title">Title:</label> <!-- Label for the title input -->
                    <input class="hw_input" type="text" id="title" name="title" required><br> <!-- Input field for the title -->
                </div>
                
                <fieldset>
                    <legend>Description:</legend> <!-- Legend for the description field -->
                    <textarea class="hw_input" id="new_item_description" name="description" required></textarea> <!-- Textarea for the description -->
                </fieldset>
                <button type="submit" class="hw_input" name="submit" id="submit_new_item">Submit</button> <!-- Button to submit the new list item -->
            </form>
        </div>
    </div>
    <!-- Option to add a new list item -->
</body>
</html>
