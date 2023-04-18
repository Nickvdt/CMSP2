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
    <title>Home</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<header class="header">
        <nav class="header__nav">
            <ul class="header__ul">
                <li class="header__listItem">
                    <p class="listItem__p">Je hebt de rechten van een <?php echo $_SESSION['user_type'];?></p>
                </li>
                <li class="header__listItem">
                    <a class="listItem__link" href="home.php"> Homepage</a>
                </li>
                <li class="header__listItem">
                    <a class="listItem__link" href="uitloggen.php">Uitloggen</a>
                </li>
                <li  class="header__listItem">
                    <a class="listItem__link" href="admin.php"<?php show_admin_link(); ?> </a>
                </li>
            </ul>
        </nav>
    </header>
    
<body>

</body>

</html>
