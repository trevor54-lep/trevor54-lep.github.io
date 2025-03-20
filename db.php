<?php
error_reporting(E_ALL);
$host = 'https';
$user = 'root';
$password = '';
$dbname = 'gestion_site';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer la liste des tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    echo "<h1>Tables dans la base de données :</h1>";
    echo "<ul>";
    foreach ($tables as $table) {
        echo "<li>$table</li>";

        // Afficher le contenu de chaque table
        $stmtContent = $pdo->query("SELECT * FROM $table");
        $rows = $stmtContent->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($rows)) {
            echo "<table border='1'>";
            echo "<tr>";
            foreach (array_keys($rows[0]) as $column) {
                echo "<th>$column</th>";
            }
            echo "</tr>";

            foreach ($rows as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>(Table vide)</p>";
        }
    }
    echo "</ul>";

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
