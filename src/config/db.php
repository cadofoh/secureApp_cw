<?php
// config/db.php

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbName = 'secureapp';

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
