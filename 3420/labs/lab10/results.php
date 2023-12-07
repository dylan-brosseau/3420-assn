<?php
session_start();

// Check that the user is logged in
if (!isset($_SESSION['username'])) {
  // Don't let them see this page if they aren't
  header("Location: login.php");
  exit;
}

require './includes/library.php';

$pdo = connectDB();

$query = "SELECT `name`, `vote_count` FROM `3420_candies` ORDER BY `vote_count` DESC";
$votes_stmt = $pdo->query($query);

$query = "SELECT SUM(`vote_count`) AS `total` FROM `3420_candies`";
$total_stmt = $pdo->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./styles/main.css">
  <title>Wonka's Voting Results</title>
</head>

<body>
  <?php include './includes/header.php' ?>

  <div>
    <?php include './includes/nav.php' ?>

    <main>
      <h1>Candy Voting Results</h1>

      <table>
        <thead>
          <tr>
            <th scope="col">Candy</th>
            <th scope="col">Number of votes</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($votes_stmt as $row): ?>
            <tr>
              <td><?= $row['name'] ?></td>
              <td><?= $row['vote_count'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>

        <tfoot>
          <th scope="row">Total votes</th>
          <td><?= $total_stmt->fetchColumn() ?></td>
        </tfoot>
      </table>
    </main>
  </div>

  <?php include './includes/footer.php' ?>
</body>

</html>
