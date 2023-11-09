<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file -->

    <title>Create New List</title> <!-- Setting the page title -->
</head>

<body>
    <nav>
        <ul class="pageheader">
            <li>
                <a href="login.html">Login</a> <!-- Navigation link to the "Login" page -->
            </li>
            <li>
                <a href="my_profile.html">My Profile</a> <!-- Navigation link to the "My Profile" page -->
            </li>
            <li>
                <a href="index.html">Main Page</a> <!-- Navigation link to the "Main Page" -->
            </li>
            <li>
                <a href="search.html">Discover</a> <!-- Navigation link to the "Discover" page -->
            </li>
            <li>
                <a href="list.html">Public Lists</a> <!-- Navigation link to the "Public Lists" page -->
            </li>
        </ul>   
    </nav>
    
    <div class="paper_container">
        <h1 class="page_list_title">Create a New List</h1> <!-- Heading for the page -->
        
        <form class="add_list" name="add_list" id="add_list">
            <div>
                <label>List Title: </label> <!-- Label for the list title input field -->
                <input type="text" name="title" id="title"> <!-- Input field for the list title -->
            </div>
            <div>
                <label>Description: </label> <!-- Label for the description input field -->
                <input type="text" name="username" id="username"> <!-- Input field for the list description -->
            </div>
            <div>
                <label for="access">I'd like my list to be </label> <!-- Label for the access type selection -->
                <select name="access" id="access"> <!-- Dropdown for selecting list access type -->
                    <option value="Private" selected>Private</option> <!-- Default option: Private -->
                    <option value="Public">Public</option> <!-- Option: Public -->
                </select>
            </div>
    
            <button type="submit">Submit</button> <!-- Submit button for the form -->
        </form>
    </div>
</body>
</html>
