<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>Discover</title> <!-- Setting the page title -->
</head>
<body class="search_page">
    <nav>
        <ul class="pageheader"> <!-- Unordered list for navigation links in the page header -->
            <li>
                <a href="login.php">Login</a> <!-- Link to the Login Page -->
            </li>

            <li>
                <a href="index.php">Main Page</a> <!-- Link to the Main Page -->
            </li>

            <li>
                <a href="my_profile.php">My Profile</a> <!-- Link to My Profile Page -->
            </li>

            <li>
                <a href="list.php">My Public Lists</a> <!-- Link to the user's public lists -->
            </li>

            <li>
                <a href="add_list.php">New List</a> <!-- Link to create a new list -->
            </li>
        </ul>    
    </nav>

    <div class="parent"> <!-- Parent container for search and lucky sections -->
        <div class="container1">
            <h2>Discover Bucket List Items</h2> <!-- Heading for discovering bucket list items -->
            
            <label for="searchInput">Search:</label> <!-- Label for search input field -->
            <input class="reg_input" type="text" id="searchInput" name="searchInput" placeholder="Enter keywords..."> <!-- Search input field -->
            <button type="submit">Search</button> <!-- Search button -->
        
            <h2>Search Results</h2> <!-- Heading for displaying search results -->
            <ul>
                <!-- Display search results here -->
                <li><a href="view_item.php">Search Result 1</a></li> <!-- Result 1 with a link to view details -->
                <li><a href="view_item.php">Search Result 2</a></li> <!-- Result 2 with a link to view details -->
                <!-- Repeat this pattern for each search result -->
            </ul>
        </div>

        <div class="container2">
            <h2>Feeling Lucky?</h2> <!-- Heading for the "Feeling Lucky" section -->
            <button id="feelingLuckyButton">I'm Feeling Lucky</button> <!-- Button for generating a random suggestion -->
            <!-- Display a random suggestion here -->
            <p><a href="view_item.php">Random Suggestion: Bucket List Item</a></p> <!-- A random suggestion with a link to view details -->
        </div>
    </div>
</body>
</html>
