<!-- 
    Ce fichier représente la page de liste par type de pokémon du site.
-->
<?php
require_once("head.php");
?>
<?php
require_once("database-connection.php");

// Requête SQL pour récupérer les types de Pokémon
$sql_types = "SELECT libelleType, IdType FROM typepokemon ORDER BY IdType";
$result_types = $databaseConnection->query($sql_types);

// Afficher les boutons pour chaque type de Pokémon
if ($result_types->num_rows > 0) {
    echo "<h1 class=titre>Boutons par Type Pokémon</h1>";

    while($row = $result_types->fetch_assoc()) {
        echo '<a href="list-by-type.php?type='.$row['IdType'].'" class=tableau_type>'. $row["libelleType"] . '</a>';
    }
;
} else {
    echo "Aucun type trouvé";
}

if(isset($_GET['type'])) {
    $Idtype = $_GET['type'];

    // Requête SQL pour récupérer les Pokémon correspondant au type sélectionné
    $sql = "SELECT libelleType, IdType, P.IdPokemon, P.NomPokemon, P.urlPhoto FROM typepokemon T
        LEFT JOIN pokemon P ON T.IdType = P.IdTypePokemon 
        LEFT JOIN pokemon P2 ON T.IdType = P2.IdSecondTypePokemon 
        WHERE P.IdTypePokemon = $Idtype 
        OR P2.IdSecondTypePokemon = $Idtype";
    $query = $databaseConnection->query($sql);

    $typeResult=$query->fetch_assoc();
    $typelibelle=$typeResult['libelleType'];

    // Afficher la liste des Pokémon correspondants
    if ($query->num_rows > 0) {
        $result = $query->fetch_all(MYSQLI_ASSOC);
        echo "<h2 class=titre>Pokémon de type ".$typelibelle." :</h2>";
        echo "<table class ='tableau_Type_pokemon'>";
        echo "<th class = tableau_t>Numéro</th>
        <th class = tableau_t>Nom</th>
        <th class = tableau_t>Photo</th>";
        foreach ($result as $row) {
            echo "<tr><td class = tableau_all>" . $row["IdPokemon"] . 
            "</td><td class = tableau_all>" . $row["NomPokemon"] . 
            "</td><td class = tableau_all><img src='" . $row["urlPhoto"] . 
            "'></td></tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun Pokémon trouvé pour ce type";
    }
}


?>
<?php
require_once("footer.php");
?>