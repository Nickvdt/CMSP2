<?php
require_once('../Private/init.php');
require_once('../Private/functions.php');
require_once('../Private/database.php');

class User {
    private $username;
    private $password;
    private $user_type;
    private $image;

    public function __construct($username, $password, $user_type, $image) {
        $this->username = $username;
        $this->password = $password;
        $this->user_type = $user_type;
        $this->image = $image;
    }

    public function save() {
        $db = new Database(); // assuming Database class exists and creates a database connection

        $stmt = $db->prepare("INSERT INTO users (username, password, user_type, image) VALUES (:username, :password, :user_type, :image)");

        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':user_type', $this->user_type);
        $stmt->bindParam(':image', $this->image);

        $stmt->execute();
        if ($db->changes() > 0) {
            echo "Afbeelding is succesvol opgeslagen in de database";
        } else {
            echo "Er is iets misgegaan tijdens het opslaan van de afbeelding";
        }
    }
}

class ImageUploader {
    private $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    public function upload() {
        if(isset($_POST['submit'])) {
            $file = $_FILES['image'];
            $fileName = $file['name'];
            $fileSize = $file['size'];
            $fileError = $file['error'];
            $fileType = $file['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            if(in_array($fileActualExt, $this->allowedExtensions)) {
                if($fileError === 0) {
                    if($fileSize < 1000000) {
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file($file['tmp_name'], $fileDestination);

                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $user_type = $_POST['user_type'];

                        $user = new User($username, $password, $user_type, $fileDestination);
                        $user->save();
                    } else {
                        echo "Het bestand is te groot";
                    }
                } else {
                    echo "Er is een fout opgetreden tijdens het uploaden van het bestand";
                }
            } else {
                echo "Dit bestandstype is niet toegestaan";
            }
        }
    }
}

$imageUploader = new ImageUploader();
$imageUploader->upload();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="image" required>
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <select name="user_type" required>
        <option value="">Selecteer een optie</option>
        <option value="user">Gebruiker</option>
        <option value="admin">Admin</option>
    </select>
    <input type="submit" name="submit" value="Upload">
</form>
</body>
</html>