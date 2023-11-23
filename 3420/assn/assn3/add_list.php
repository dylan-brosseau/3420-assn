<?php
session_start();
require './includes/library.php';
$pdo = connectDB();
$is_logged_in = isset($_SESSION['username']) ? true : false;

//redirect to login page if the user is not logged in
if (!$is_logged_in){header("Location: login.php"); exit();}

$title  = $_POST['title'] ?? "";
$description  = $_POST['description'] ?? "";
$access  = $_POST['access'] ?? null;

$errors = array();

if (isset($_POST['submit']))
{
    if (empty($title) || strlen($title) > 255) {
        $errors['title'] = true;
    } 
    if (empty($description) || strlen($description) > 255) {
        $errors['description'] = true;
    }

    if(empty($errors))
    {
        $stmt = $pdo->prepare("INSERT INTO assn_user_lists
        (username, title, description, access) VALUES (?,?,?,?)");
        $stmt->execute([$_SESSION['username'], $title, $description, $access]);
    }
    
    

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file -->

    <title>Create New List</title> <!-- Setting the page title -->
</head>

<body>

    <?php include './includes/nav.php'?>

    
    <div class="paper_container">
        <h1 class="page_list_title">Create a New List</h1> <!-- Heading for the page -->
        
        <form class="add_list" name="add_list" id="add_list" method="post">
            <div>
                <label>List Title: </label> <!-- Label for the list title input field -->
                <input type="text" name="title" id="title" required> <!-- Input field for the list title -->
                <span class="error <?= !isset($errors['title']) ? 'hidden' : '' ?>">Invalid title</span>

            </div>
            <div>
                <label>Description: </label> <!-- Label for the description input field -->
                <input type="text" name="description" id="description" required> <!-- Input field for the list description -->
                <span class="error <?= !isset($errors['description']) ? 'hidden' : '' ?>">Invalid description</span>

            </div>
            <div>
                <label for="access">I'd like my list to be </label> <!-- Label for the access type selection -->
                <select name="access" id="access"> <!-- Dropdown for selecting list access type -->
                    <option value='private' selected>Private</option> <!-- Default option: Private -->
                    <option value='public'>Public</option> <!-- Option: Public -->
                </select>
            </div>
    
            <button type="submit" name="submit">Submit</button> <!-- Submit button for the form -->
        </form>
    </div>
</body>
</html>
