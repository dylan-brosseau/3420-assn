<?php
// *****************************************************************************
// Process form here:
// *****************************************************************************

$username  = $_POST['username'] ?? "";
$password  = $_POST['password'] ?? "";

$errors = array();

if (isset($_POST['submit']))
{
  require './includes/library.php';
  $pdo = connectDB();
 
  $user_stmt = $pdo->prepare("SELECT * FROM 3420_users WHERE username = ?");
  $user_stmt->execute([$username]);
  $user = $user_stmt->fetch();

  if (!$user)
  {
    $errors['username']=true;
  }
  else if (password_verify($password, $user['password']))
  {
    session_start();
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location: results.php");
    exit();
  }
  else
  {
    $errors['password'] = true;
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./styles/main.css">
  <title>Wonka's Voting Results - Login</title>
</head>

<body>
  <?php include './includes/header.php' ?>

  <div>
    <?php include './includes/nav.php' ?>

    <main>
      <h1>Log in to View Wonka's Voting Results</h1>

      <form id="login-form" method="post">
        <div class="centered">
          <label for="username">Username:</label>
          <input
            type="text"
            name="username"
            id="username"
            placeholder="johnsmith"
            value="<?= $username ?>"
          >

          <span class="error <?= !isset($errors['username']) ? 'hidden' : '' ?>">That user does not exist.</span>
        </div>

        <div class="centered">
          <label for="password">Password:</label>
          <input
            type="password"
            name="password"
            id="password"
          >

          <span class="error <?= !isset($errors['password']) ? 'hidden' : '' ?>">That password is incorrect.</span>
        </div>

        <div class="centered">
          <label for="remember-me">Remember me:</label>
          <input
            type="checkbox"
            name="remember"
            id="remember-me"
            value="Y"
          >
        </div>

        <button type="submit" name="submit" id="submit" class="centered">Log in</button>
      </form>
    </main>
  </div>

  <?php include './includes/footer.php'; ?>
</body>

</html>
