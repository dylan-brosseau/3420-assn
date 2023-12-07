<?php
$errors = array();

$username = $_POST['username'] ?? $_COOKIE['remember'] ?? "";
$password = $_POST['password'] ?? "";

// Bonus: make 'remember me' work
$remember = $_POST['remember'] ?? "N";
$remember = $remember == "Y"; // true/false


if (isset($_POST['submit'])) {

  require './includes/library.php';
  $pdo = connectDB();

  // Check database for a user with this username
  $query = "SELECT * FROM `3420_users` WHERE `username` = ?";
  $user_stmt = $pdo->prepare($query);
  $user_stmt->execute([$username]);

  $user = $user_stmt->fetch();

  // There was nobody in the database:
  if ($user === false) {
    $errors['username'] = true;
  }

  // There was someone in the database, and their password was correct:
  else if (password_verify($password, $user['password'])) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user['id'];

    // Bonus: make 'remember me' work
    if ($remember) {
      $expiry = time() + 86400 * 30; // 86400 secs = 24hrs. times 30 = 30 days
      setcookie("remember", $username, $expiry);
    } else {
      setcookie("remember", "", 1); // timestamp in past (1) will delete cookie
    }

    // Send them to results
    header("Location: results.php");
    exit;
  }

  // There was someone in the database, but their password was incorrect:
  else {
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
            <?= $remember ? 'checked' : '' ?>
          >
        </div>

        <button type="submit" name="submit" id="submit" class="centered">Log in</button>
      </form>
    </main>
  </div>

  <?php include './includes/footer.php'; ?>
</body>

</html>
