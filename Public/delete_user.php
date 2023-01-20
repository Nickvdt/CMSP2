<?php
require_once('../Private/init.php');
require_once('../Private/functions.php');
require_once('../Private/database.php');

// check if user id is passed in the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('location: admin.php');
    exit;
}

// check if user is logged in and has permission to delete user
if (is_logged_in()==false) {
    header('location: login.php');
    exit;
}

$id = $_GET['id'];

// delete user from the database
$query = "DELETE FROM users WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    header('location: admin.php');
    exit;
} else {
    echo "Er is iets misgegaan tijdens het verwijderen van de gebruiker";
}