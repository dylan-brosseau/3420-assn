<?php

// Declare empty array to add errors too
$errors = array();

// Get inputs from $_POST, or set them to sensible defaults if they don't exist
$name = $_POST['name'] ?? "";
$email = $_POST['email'] ?? "";
$perspective = $_POST['perspective'] ?? "";
$choice = $_POST['choice'] ?? "";
$agree = $_POST['agree'] ?? "";


if (isset($_POST['submit'])) { // (only run if the form has just been submitted)

  // Validate that the user has entered a name (since names are a string that
  // could be just about anything, its validation is simple)
  if (strlen($name) === 0) {
    $errors['name'] = true; // put a flag in the errors array
  }

  // Put the rest of your form validation here:
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){$errors ['email'] = true;;}
  if ($perspective === ""){$errors ['perspective'] = true;}
  if ($choice === "0"){$errors['candy'] = true;}
  if ($agree != "Y"){$errors['agree'] = true;}
  // ...

  // If no errors were found after all of the above validation, redirect:
    if (empty($errors)){header('Location: thankyou.php');
      exit();
    }
  // ...
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./styles/main.css">
  <title>Vote for Wonka's Next Candy!</title>
</head>

<body>
  <div>
    <?php include 'includes/header.php'?>
    <?php include 'includes/nav.php'?>

    <main>
      <h1>Vote for Wonka's<sup>&reg;</sup> next candy!</h1>

      <form id="main-form" method="post" novalidate>
        <div>
          <label for="name">Name:</label>
          <input
            type="text"
            name="name"
            id="name"
            placeholder="John Smith"
            value="<?= $name ?>"
          >

          <span class="error <?= !isset($errors['name']) ? 'hidden' : '' ?>">Please enter your name.</span>
        </div>

        <div>
          <label for="email">Email Address:</label>
          <input
            type="email"
            name="email"
            id="email"
            placeholder="john.smith@gmail.com"
            value="<?= $email ?>"
          >

          <span class="error <?= !isset($errors['email']) ? 'hidden' : '' ?>">Please enter a correct email.</span>
        </div>

        <fieldset>
          <legend>Perspective</legend>

          <div>
            <input
              type="radio"
              name="perspective"
              id="radio-customer"
              value="customer" <?= $perspective == 'customer' ? 'checked' : '' ?>
            >
            <label for="radio-customer">Customer</label>
          </div>

          <div>
            <input
              type="radio"
              name="perspective"
              id="radio-reseller"
              value="reseller"
              value="reseller" <?= $perspective == 'reseller' ? 'checked' : '' ?>

            >
            <label for="radio-reseller">Reseller</label>
          </div>

          <div>
            <input
              type="radio"
              name="perspective"
              id="radio-oompa"
              value="oompa"
              value="oompa" <?= $perspective == 'oompa' ? 'checked' : '' ?>

            >
            <label for="radio-oompa">Oompa-Loompa</label>
          </div>
        </fieldset>

        <span class="error <?= !isset($errors['perspective']) ? 'hidden' : '' ?>">Please identify your perspective.</span>

        <div class="centered">
          <label for="choice">Product Choice:</label>
          <select name="choice" id="choice">
            <option value="0">Select an option</option>
            <option value="1" <?= $choice == '1' ? 'selected' : '' ?>>Piglets</option>
            <option value="2" <?= $choice == '2' ? 'selected' : '' ?>>Snowballs</option>
            <option value="3" <?= $choice == '3' ? 'selected' : '' ?>>Yumyums</option>
            <option value="4" <?= $choice == '4' ? 'selected' : '' ?>>Puffs</option>
            <option value="5" <?= $choice == '5' ? 'selected' : '' ?>>Yahoos</option>
            <option value="6" <?= $choice == '6' ? 'selected' : '' ?>>Doodles</option>
          </select>

          <span class="error <?= !isset($errors['candy']) ? 'hidden' : '' ?>">Please choose a candy.</span>
        </div>

        <div class="centered">
          <input
            type="checkbox"
            name="agree"
            id="agree"
            value="Y"
            <?= $agree == 'Y' ? 'checked' : '' ?>
          >
          <label for="agree">I agree to the <a href="">Terms and Conditions</a>.</label>

          <span class="error <?= !isset($errors['agree']) ? 'hidden' : '' ?>">You must agree to the terms.</span>
        </div>

        <button type="submit" name="submit" id="submit" class="centered">Submit Vote</button>
      </form>
    </main>
  </div>
  <?php include 'includes/footer.php'?>


</body>

</html>
