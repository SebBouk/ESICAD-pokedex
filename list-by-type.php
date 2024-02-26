<!-- 
    Ce fichier représente la page de liste par type de pokémon du site.
-->
<?php
require_once("head.php");
?>
<?php
require_once("database-connection.php");

// Requête SQL pour récupérer les types de Pokémon
$sql_types = "SELECT libelleType FROM typepokemon";
$result_types = $databaseConnection->query($sql_types);

// Afficher les boutons pour chaque type de Pokémon
if ($result_types->num_rows > 0) {
    echo "<h1>Boutons par Type Pokémon</h1>";
    echo "<form method='get'>";
    while($row = $result_types->fetch_assoc()) {
        echo '<input type="submit" name="type" value="' . $row["libelleType"] . '">';
    }
    echo "</form>";
} else {
    echo "Aucun type trouvé";
}

if(isset($_GET['type'])) {
    $type = $_GET['type'];

    // Requête SQL pour récupérer les Pokémon correspondant au type sélectionné
    $sql = "SELECT * FROM pokemon WHERE IdTypePokemon = (SELECT IdType FROM typepokemon WHERE libelleType = '$type') OR IdSecondTypePokemon = (SELECT IdType FROM typepokemon WHERE libelleType = '$type')";
    $result = $databaseConnection->query($sql);

    // Afficher la liste des Pokémon correspondants
    if ($result->num_rows > 0) {
        echo "<h2>Pokémon de type $type :</h2>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row["NomPokemon"] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "Aucun Pokémon trouvé pour ce type";
    }
}


?>
<?php
require_once("footer.php");
?>