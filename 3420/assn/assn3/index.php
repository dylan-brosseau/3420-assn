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
                <li>Before I'm Married</li> <!-- List names -->
                <li>Before I Die</li>
                <li>List3</li>
            </ul>
            
            <h2>Me</h2> <!-- Heading for user's profile links -->
            <ul>
                <li>[Username]</li> <!-- Displaying the username -->
                <li><a href="my_profile.html">Edit Profile</a></li> <!-- Link to edit user's profile -->
                <li><a href="login.html">Sign out</a></li> <!-- Link to sign out from the account -->
            </ul>
        </div>

        
        <div class="index_container"> <!-- Container for displaying list details -->   
            <h1 class="page_list_title">Before I'm Married</h1> <!-- Heading for the list title -->
            <p><strong>List Description:</strong></p> <!-- Displaying a description of the list -->
            <p>This list is all about the things I want to do before I'm married. It.....</p>
            <!-- Additional details about the list -->
            <br> <!-- Line break for separation -->
            
            <!-- List of Bucket List Items -->
            <ul class="bucket_list"> <!-- Unordered list for displaying list items -->
                <!-- List Item 1 -->
                <li>
                    <p><strong>Entry:</strong> Visit Paris</p> <!-- Displaying list item title -->
                    <p><strong>Description:</strong> I want to go to Paris because...</p> <!-- Displaying the description of the list item -->
                    <p><strong>Status:</strong> Incomplete</p> <!-- Displaying the status of the list item -->
                    <p>
                        <a href="view_item.html">View Details</a> | <!-- Link to view the details of the list item -->
                        <a href="edit_item.html">Edit</a> | <!-- Link to edit the list item -->
                        <a href="#">Delete</a> <!-- Option to delete the list item -->
                    </p>
                </li>
                
                <hr /> <!-- Horizontal rule for separation -->
                
                <!-- List item 2 -->
                <li>
                    <p><strong>Entry:</strong> Climb Mount Everest</p> <!-- Displaying list item title -->
                    <p><strong>Description:</strong> Conquer the world's highest peak.</p> <!-- Displaying the description of the list item -->
                    <p><strong>Status:</strong> Completed</p> <!-- Displaying the status of the list item -->
                    <p>
                        <a href="view_item.html">View Details</a> | <!-- Link to view the details of the list item -->
                        <a href="edit_item.html">Edit</a> | <!-- Link to edit the list item -->
                        <a href="#">Delete</a> <!-- Option to delete the list item -->
                    </p>
                </li>
                <!-- Here we can add more fake lists -->
            </ul>         
        </div>
    
        <div class="index_add"> <!-- Container for adding a new list item -->
            <form class="index_container" method="POST">
                <h2>Add New Entry</h2> <!-- Heading for adding a new list item -->
                <div>
                    <label for="title">Title:</label> <!-- Label for the title input -->
                    <input class="hw_input" type="text" id="title" name="title" required><br> <!-- Input field for the title -->
                </div>
                
                <fieldset>
                    <legend>Description:</legend> <!-- Legend for the description field -->
                    <textarea class="hw_input" id="new_item_description" name="description" required></textarea> <!-- Textarea for the description -->
                </fieldset>
                <button type="submit" class="hw_input" id="submit_new_item">Submit</button> <!-- Button to submit the new list item -->
            </form>
        </div>
    </div>
    <!-- Option to add a new list item -->
</body>
</html>
