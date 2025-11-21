<?php
require_once 'connexion.php';


function getAllStudents()
{
    try {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM students');

        return $stmt->fetchAll();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des données : " . $e->getMessage();
    }
    return null;
}
