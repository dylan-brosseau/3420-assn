<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>Public Lists View</title> <!-- Setting the page title -->
</head>
<body class="public_list_page">
    <nav>
        <ul class="pageheader"> <!-- Unordered list for navigation links in the page header -->
            <li>
                <a href="index.html">Main</a> <!-- Link to the Main Page -->
            </li>
            <li>
                <a href="login.html">Login</a> <!-- Link to the Login Page -->
            </li>

            <li>
                <a href="my_profile.html">My Profile</a> <!-- Link to My Profile Page -->
            </li>

            <li>
                <a href="search.html">Discover</a> <!-- Link to the Discover Page -->
            </li>

            <li>
                <a href="add_list.html">New List</a> <!-- Link to the New List Page -->
            </li>
        </ul>    
    </nav>
    <header>
        <h2 id="list_page_header">Public Lists</h2> <!-- Heading for the Public Lists page -->
        <!-- Include any header content or navigation links here -->
    </header>

    <main>
        
        <div class="index_container"> <!-- Container for displaying public lists -->
            
            <ul class="bucket_list"> <!-- Unordered list for displaying public lists -->

                <h2 class="page_list_title">Before I'm Married</h2> <!-- Heading for a specific public list -->
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
        
                <h2 class="page_list_title">Before I Die</h2> <!-- Heading for another specific public list -->
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
        
            </ul>
        
        </div>
    </main>

    
</body>
</html>