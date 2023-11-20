
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/assn.css" />

    <title>Index</title>
</head>
<body class="index_page">
    
        <nav>
            <ul class="pageheader">
                <li>
                    <a href="index.php">Main</a>
                </li>
                <li>
                    <a href="login.php"><?php echo $is_logged_in ? 'Logout' : 'Login'; ?></a>
                </li>
    
                <li>
                    <a href="my_profile.php">My Profile</a>
                </li>
    
                <li>
                    <a href="list.php">My Public Lists</a>
                </li>
    
                <li>
                    <a href="search.php">Discover</a>   
                </li>
    
                <li>
                    <a href="add_list.php">New List</a>
                </li>
            </ul>    
        </nav>

</body>