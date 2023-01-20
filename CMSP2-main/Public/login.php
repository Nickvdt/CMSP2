<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body class="body__login">
    <form class="form__login" method="POST" action="">
        <h2 class="form__login--h2">Inlogpagina</h2>
        <div class="form__login--div">
            <label for="username">Gebruikersnaam</label>
            <input class="input__veld" type="text" name="username" id="username" required>
        </div>
        <div class="form__login--div">
            <label for="password">Wachtwoord</label>
            <input class="input__veld" type="password" name="password" id="password" required>
        </div>

        <div class="form__login--div">
            <select id="user_type" name="user_type" required>
                <option value="">Selecteer een optie</option>
                <option value="user">Gebruiker</option>
                <option value="admin">Admin</option>
                <option value="editor">Editor</option>
            </select>
            <input class="form__login--submit" type="submit" name="button" value="Inloggen">
        </div>

        <section class="login__section">
            <p class="login__section--p">Geen account? klik <a href="aanmelden.php">hier</a></p>
        </section>

        <?php
        require_once('../Private/init.php');
        require_once('../Private/functions.php');
        require_once('../Private/database.php');

        if (is_logged_in()) {
            header('location: home.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user_type = $_POST['user_type'];
            global $db;

            $user = get_user($username, $password, $user_type);

            if ($user) {
                login_user($username, $user_type);
                switch ($user_type) {
                    case 'admin':
                        header('location: admin.php');
                        exit;
                        break;
                    case 'editor':
                        header('location: editor.php');
                        exit;
                        break;
                    case 'user':
                        header('location: home.php');
                        exit;
                        break;
                    default:
                        header('location: home.php');
                        exit;
                        break;
                }
            } else {
                echo "<div class='error'>Ongeldige gebruikersnaam, wachtwoord of gebruikerstype</div>";
            }
        }
        ?>
    </form>
</body>

</html>