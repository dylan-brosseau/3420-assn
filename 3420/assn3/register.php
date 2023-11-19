<?php


require './includes/library.php';
$errors = array();
$must_be_unique = array();

$name = $_POST['name']?? "";
$username         = $_POST['username'] ?? "";
$email        = $_POST['email'] ?? "";
$password  = $_POST['password'] ?? null;
$c_password  = $_POST['c_password'] ?? null;
$list_title  = $_POST['list_title'] ?? null;
$list_description  = $_POST['list_description'] ?? null;
$is_public  = $_POST['is_public'] ?? null;




//connect to database
$pdo = connectDB();

$_SESSION['login_attempts'] = 0;

//if the form is submitted
if (isset($_POST['submit']))
{
    
    // is a username entered
    if (strlen($username) === 0){ $errors['username'] = true;}
  
    // check if username is taken
    $stmt = $pdo->prepare("SELECT username FROM assn_accounts WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetchColumn()) {$must_be_unique['username'] = true;}

    // email validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {$errors['email'] = true;}

    //password validation
    if ($password != $c_password) {$errors['password'] = true;}


    
    //-----If there are no errors----
    //var_dump($_POST);
   // var_dump($errors);

    if (count($errors) === 0 && count($must_be_unique) === 0)
    {
        //insert account data
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare
        ("INSERT INTO assn_accounts (username, email, name, password)
          VALUES (?,?,?,?)
        ");
        $stmt->execute([$username, $email, $name, $hashed_password]);

        $stmt = $pdo->prepare
        ("INSERT INTO assn_user_lists (username, title, description, is_public)
          VALUES (?,?,?,?)
        ");
        $stmt->execute([$username, $list_title, $list_description, $is_public]);

        header('Location: index.php');
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"> <!-- Character encoding for the document -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Setting the viewport for responsive design -->
    <link rel="stylesheet" href="./css/assn.css" /> <!-- Including an external CSS file for styling -->
    <title>User Registration</title> <!-- Setting the page title -->
</head>

<body class="register"> <!-- Assigning a class to the body element for styling -->
    <main>
        <a href="login.php">Back to Login Page</a> <!-- Link to return to the login page -->
        <div class="registerpage"> <!-- Stylish container for the registration form -->
            <h1>User Registration</h1> <!-- Heading for the registration section -->

            <!-- User Information -->
            <form name="register" method="post" action="">

                <div class="registerinfo">
                    <div>
                        <input type="text"
                          id="username"
                          name="username" 
                          placeholder="Username">
                        <!-- Error messages -->
                        <span class="error <?= !isset($errors['username']) ? 'hidden' : '' ?>">Please enter a valid username.</span>
                        <span class="error <?= !isset($must_be_unique['username']) ? 'hidden' : '' ?>">This username is taken.</span>

                    </div>
                    
                    <div>
                        <input
                         type="text" 
                         id="name"
                         name="name"
                         placeholder="Name" 
                         value="<?= $name ?>" >

                        <!-- Input field for entering a full name (required) -->
                    </div>
                    
                    <div>
                        <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        placeholder="Email"
                        value="<?= $email?>" >
                        <!-- Input field for entering an email address (required) -->
                    </div>
                
                    <div>
                        <input type="password" id="password" name="password" placeholder="Password" required >
                        <!-- Password will not be sticky-->
                    </div>
                    
            
                    <div>
                        <input type="password" id="c_password" name="c_password" placeholder="Confirm Password" >
                        <!-- Confirm password will also not be sticky -->
                    </div>
                </div>

                <!-- List Information -->
                <div class="registerlist">
                    <h2>List Information</h2> <!-- Subheading for list-related information -->
                
                    <div>
                        <input 
                        type="text" 
                        id="list_title" 
                        name="list_title" 
                        placeholder="List Name"
                        value="<?=$list_title?>" >
                        <!-- Input field for entering a list name (required) -->
                    </div>
                    
                    <div>
                        <textarea 
                        id="list_description" 
                        name="list_description" 
                        rows="2" 
                        placeholder="Description" 
                        value="<?=$list_description?>">
                        </textarea>
                        <!-- Text area for entering a list description (required) -->
                    </div>
                    
                    <div class="registercheckbox">
                    <label><input 
                    type="checkbox" 
                    id="is_public" 
                    name="is_public"
                    value=1
                    <?= $is_public === 1 ? 'checked' : '' ?>
                    >  
                    Make List Public</label>
                    <!-- Checkbox for making the list public -->
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" name="submit">Submit</button>
                    <!-- Button to submit the registration form -->
            </div>
            </form>
            
        </div>
    </main>
</body>
</html>