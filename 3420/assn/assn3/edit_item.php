<?php

session_start();
require './includes/library.php';
$is_logged_in = isset($_SESSION['username']) ? true : false;

$pdo = connectDB();
$item_id = $_GET['param'];

$stmt= $pdo->prepare("SELECT * FROM assn_list_entries WHERE id = ?");
$stmt->execute([$item_id]);
$entry = $stmt->fetch();

if($entry['username'] != $_SESSION['username']){header("Location: index.php");}

$errors = array();

$title = $_POST['title']?? "";
$description = $_POST['description']?? "";
$status= $_POST['status']?? "";
$date= $_POST['completion_date']?? null;
$rating= $_POST['rating']?? "";



if (isset($_POST['submit']))
{
    if (empty($title) || strlen($title) > 255) {
        $errors['title'] = true;
    } 
    if (empty($description) || strlen($description) > 255) {
        $errors['description'] = true;
    } 
    if($date == ''){$date = null;}

    

    if (empty($errors)){

    
        $stmt = $pdo->prepare("UPDATE assn_list_entries SET
        entry_name = ?, status = ?, description = ?, completion_date = ?, rating = ? WHERE id = ?");
        $success = $stmt->execute([$title, $status ? "complete" : "incomplete", $description, $date, $rating, $item_id]);
        
        if ($success) {
            // Redirect to the main page
            header("Location: index.php");
            exit();
        } else {
            // Display an error message
            echo "Error: Data update failed.";
        }
    }
     
}

//var_dump($entry);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file -->

    <title>Edit List Item</title> <!-- Setting the page title -->
</head>

<body class="edititem">
    
    <!-- User can edit list -->
    <main>
    <ul>
       <li>
            <a href="index.php">Back to Main List</a> <!-- Navigation link to the "Main List" -->
       </li> 
    </ul>
    
    <form method="POST" > <!-- Form for editing list item -->
        <div class="edititempage">
            <h1>Edit List Item</h1> <!-- Heading for the edit page -->
            <div>
                <input type="text" id="title" name="title" value="<?= $entry['entry_name']?>" required> <!-- Input field for the title of the list item -->
                <span class="error <?= !isset($errors['title']) ? 'hidden' : '' ?>">Invalid title</span>

            </div>
            
            <div>
                <textarea id="description" name="description" required><?= $entry['description']?></textarea> 
                <span class="error <?= !isset($errors['description']) ? 'hidden' : '' ?>">Invalid description</span>

            </div>
    
            <fieldset class="edititemset">
                <legend>Complete</legend> <!-- Legend for the status field -->
                  
                <div>
                    <input type="checkbox" name="status" id="completed" value="c" <?= $entry['status'] == "incomplete" ? '' : 'checked' ?>>
                  </div>
                  
                
                <legend>Rating</legend> <!-- Legend for the rating field -->
                <div>
                    <input type="range" id="rating" name="rating" min="1" max="5" value="<?= $entry['rating'] ? $entry['rating']: 1?>"> <!-- Slider for rating the item (1-5) -->
                </div>
            </fieldset>
            
            <fieldset>
                <legend>Completion Date</legend> <!-- Legend for the completion date field -->
                <div>
                    <input type="date" id="completion_date" name="completion_date" placeholder="N/A" value="<?= $entry['completion_date']?>"> <!-- Input field for specifying the completion date -->
                </div>
            </fieldset>
          
            <div>
                <input type="file" id="proof" name="proof" accept="image/*"  placeholder="Input Image"> <!-- File input for uploading proof images -->
            </div>
    
            <button type="submit" name="submit">Save Changes</button> <!-- Submit button for saving changes to the list item -->

        </div>

       
        </form>
    </main>
    
</body>
</html>
