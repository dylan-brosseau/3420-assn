<?php

// Declare empty array to add errors to
$errors = array();

// Get inputs from $_POST, or set them to sensible defaults if they don't exist.
// This ensures they are always, at the very least, set when our later code
// needs to access them (otherwise we'd get an error).
$name         = $_POST['name'] ?? "";
$email        = $_POST['email'] ?? "";
$perspective  = $_POST['perspective'] ?? null;
$choice       = $_POST['choice'] ?? 0;
$agree        = $_POST['agree'] ?? 'N';


// *****************************************************************************
// Include library, make database connection, and query for dropdown list
// information here:
// *****************************************************************************
require './includes/library.php';
$pdo = connectDB();
$stmt = $pdo->query("SELECT id, name FROM 3420_candies ORDER BY name ASC");

// ...


if (isset($_POST['submit'])) {

  /* ----------------- Form validation (from the last lab) ------------------ */

  // Validate that the user has entered a name (since names are a string that
  // could be just about anything, its validation is simple)
  if (strlen($name) === 0) {
    $errors['name'] = true;
  }

  // Ensure that the user has entered a valid email address
  if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    $errors['email'] = true;
  }


try {
    // Preparing the SQL statement. The colon (:) before email is a placeholder.
    $storedEmails = $pdo->prepare("SELECT email FROM 3420_votes WHERE email = :email");

    // Binding value to a placeholder
    // This helps you to prevent SQL Injection attacks
    $storedEmails->bindValue(':email', $email); 

    // Executing the statement
    $storedEmails->execute();

    // fetching the emails
    $results = $storedEmails->fetchAll();

    if (count($results) > 0) { 
        // if the count of results is greater than 0, it means email already exists in the database
        $errors[] = "Email already exists in the database.";
    }
} 
catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

 

  if ($storedEmails != null) {$errors['email'] = true;;}

  // Ensure that the user selected a valid radio button (matches the enum values
  // in the database)
  $valid_perspectives = ['customer', 'reseller', 'oompa'];
  if (!in_array($perspective, $valid_perspectives)) {
    $errors['perspective'] = true;
  }

  // Ensure that the user picked something from the dropdown (to do this
  // *properly*, you'd test that `$choice` is an ID of something in the
  // database. For now, we'll just check that it's between 1 and 6)
  if ($choice < 1 || $choice > 6) {
    $errors['candy'] = true;
  }

  // Check that they agreed to the terms and conditions
  if ($agree !== 'Y') {
    $errors['agree'] = true;
  }

  /* ------------------ End of last lab's form validation ------------------- */


  // If there are no errors, do database work
  if (count($errors) === 0) {
    // *************************************************************************
    // Write to the database here:
    // *************************************************************************

    // Add the vote to `3420_votes`:
    $insertQuery = "INSERT INTO 3420_votes (name, email, perspective, candy_choice, entry_date) VALUES (?, ?, ?, ?, NOW())";
    $insertSuccess = $pdo->prepare($insertQuery)->execute([$name, $email, $perspective, $choice]);
    
    // Increase the vote-count in `3420_candies`:
    $updateQuery = "UPDATE 3420_candies SET vote_count = vote_count + 1 WHERE id = ?";
    $updateSuccess = $pdo->prepare($updateQuery)->execute([$choice]);


    // Then redirect:
    header("Location: thankyou.php");
    exit;
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
  <title>Vote for Wonka's Next Candy!</title>
</head>

<body>
  <?php include './includes/header.php' ?>

  <div>
    <?php include './includes/nav.php' ?>

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
              value="customer"
              <?= $perspective == 'customer' ? 'checked' : '' ?>
            >
            <label for="radio-customer">Customer</label>
          </div>

          <div>
            <input
              type="radio"
              name="perspective"
              id="radio-reseller"
              value="reseller"
              <?= $perspective == 'reseller' ? 'checked' : '' ?>
            >
            <label for="radio-reseller">Reseller</label>
          </div>

          <div>
            <input
              type="radio"
              name="perspective"
              id="radio-oompa"
              value="oompa"
              <?= $perspective == 'oompa' ? 'checked' : '' ?>
            >
            <label for="radio-oompa">Oompa-Loompa</label>
          </div>
        </fieldset>

        <span class="error <?= !isset($errors['perspective']) ? 'hidden' : '' ?>">Please identify your perspective.</span>

        <div class="centered">
          <label for="choice">Product Choice:</label>
          <select name="choice" id="choice">
            <option value="0">Select an option</option>

            <!-- ***************************************************************
              Put a for/foreach loop for your dropdown options from the database
              statement here. Use the `<option>` below as a template.
            **************************************************************** -->
            <?php foreach($stmt as $item): ?>
              <option value="<?= $item['id'] ?>" <?= $choice == $item['id'] ? 'selected' : '' ?>>
                <?= $item['name'] ?>
              </option>
            <?php endforeach; ?>
         

          </select>

          <span class="error <?= !isset($errors['candy']) ? 'hidden' : '' ?>">Please choose a candy.</span>
        </div>

        <div class="centered">
          <input
            type="checkbox"
            id="agree"
            name="agree"
            value="Y"
            <?= $agree === 'Y' ? 'checked' : '' ?>
          >
          <label for="agree">I agree to the <a href="">Terms and Conditions</a>.</label>

          <span class="error <?= !isset($errors['agree']) ? 'hidden' : '' ?>">You must agree to the terms.</span>
        </div>

        <button type="submit" name="submit" id="submit" class="centered">Submit Vote</button>
      </form>
    </main>
  </div>

  <?php include './includes/footer.php' ?>
</body>

</html>
