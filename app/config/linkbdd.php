<?php
$host = 'localhost';
$db   = 'u822133654_bddleptitcafe';
$user = 'u822133654_leptitcafe';
$pass = 'hxYUmc3gbNTjiD!C';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

test