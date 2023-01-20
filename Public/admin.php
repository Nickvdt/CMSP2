<?php
require_once('../Private/init.php');
require_once('../Private/functions.php');
require_once('../Private/database.php');
check_login();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin panel</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<header class="header">
        <nav class="header__nav">
            <ul class="header__ul">
                <li class="header__listItem">
                    <p class="listItem__p">Je hebt de rechten van een <?php echo $_SESSION['user_type'];?></p>
                </li>
                <li class="header__listItem">
                    <a class="listItem__link" href="home.php">Homepage</a>
                </li>
                <li class="header__listItem">
                    <a class="listItem__link" href="uitloggen.php">Uitloggen</a>
                </li>
                <li>
                 <?php 
                 
                 ?>
                </li>
            </ul>
        </nav>
    </header>
<body>
<div class="header">
    
    <div class="main-content">
      <h2 class="admin-h2">Welkom, Admin!</h2>
      <p class="">Dit is uw admin-paneel. Hier kunt u gebruikersbeheer, contentbeheer en andere beheerfuncties uitvoeren.</p>
    </div>

    <div class="main-content">
  <h2>Beheer gebruikers</h2>
  <table>
    <thead>
      <tr>
        <th>Gebruikersnaam</th>
        <th>Gebruikerstype</th>
        <th>Acties</th>
      </tr>
    </thead>
    <tbody>



      <?php 
        $users = get_all_users();
        foreach($users as $user) {
          echo "<tr>";
          echo "<td>" . $user['username'] . "</td>";
          echo "<td>" . $user['user_type'] . "</td>";
          echo "<td><a href='delete_user.php?id=" . $user['id'] . "'>Verwijderen</a></td>";
          echo "</tr>";

          
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>