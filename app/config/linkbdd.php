<?php

namespace App\Config; // <-- L'adresse du fichier pour éviter les erreurs si un autee fichier s'appelle pareil.

// Singleton vu en cours.

// On appelle les outils PHP dont on a besoin.
use PDO;
use Exception;

// Les identifiants prrivés
class Database {
private string $host = 'localhost';
private string $db   = 'u822133654_bddleptitcafe';
private string $user = 'u822133654_leptitcafe';
private string $pass = 'hxYUmc3gbNTjiD!C';

// "Tuyau" de connexion
private ?PDO $pdo = null;

// Est ce que la machine a déjà été créee ?
private static ?Database $instance = null;

// Constructeur privé pour empêcher de créer une nouvelle machine n'importe comment.
private function __construct() {
    try {
        // Je vais chercher mes réglages dans la "bôite" POO.
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user, $this->pass);
        // On active les alertes en cas de fautes de frappe dans le SQL.
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        // Si le tuyau ne fonctionne pas, message d'erreur.
        die('Erreur : ' . $e->getMessage());
    }
}

// Méthode pour récupérer le tuyau de connexion.
public static function getInstance(): Database {
    if (self::$instance === null) {
        self::$instance = new Database();
    }
    return self::$instance;
    }
}