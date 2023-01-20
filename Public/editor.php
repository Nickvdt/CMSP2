<?php
require_once('../Private/init.php');
require_once('../Private/functions.php');
require_once('../Private/database.php');

if(isset($_POST['submit'])) {
    // Get the file and its properties
    $file = $_FILES['image'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Get the file extension
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    // Allowed file types
    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    // Check if the file type is allowed
    if(in_array($fileActualExt, $allowed)) {
        // Check for errors
        if($fileError === 0) {
            // Check for file size
            if($fileSize < 1000000) {
                // Give the file a new unique name
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                // Set the destination for the file
                $fileDestination = 'uploads/'.$fileNameNew;
                // Move the file from the temporary location to the destination
                move_uploaded_file($fileTmpName, $fileDestination);

                $username = $_POST['username'];
                $password = $_POST['password'];
                $user_type = $_POST['user_type'];
                // Prepare the SQL statement
                $stmt = $db->prepare("INSERT INTO users (username, password, user_type, image) VALUES (:username, :password, :user_type, :image)");
                // Bind the parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':user_type', $user_type);
                $stmt->bindParam(':image', $fileDestination);
// Execute the statement
$stmt->execute();
if ($db->changes() > 0) {
    echo "Afbeelding is succesvol opgeslagen in de database";
} else {
    echo "Er is iets misgegaan tijdens het opslaan van de afbeelding";
}
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