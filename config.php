<?php
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Path to the JSON configuration file
$configFilePath = 'config.json';

// Check if the file exists
if (!file_exists($configFilePath)) {
    die('Configuration file not found.');
}

// Read the JSON file
$jsonContent = file_get_contents($configFilePath);

// Decode the JSON content into a PHP associative array
$config = json_decode($jsonContent, true);

// Check if JSON decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}

$host = $config['database']['host'];
$user = $config['database']['username'];
$pass = $config['database']['password'];
$db = $config['database']['dbname'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}