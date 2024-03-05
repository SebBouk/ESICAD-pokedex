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
    echo "<h1 class=titre>Type Pokémon</h1>";

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
    $sql = "SELECT T.libelleType, T.IdType, P.IdPokemon, P.NomPokemon, P.urlPhoto, P.IdSecondTypePokemon, P.IdTypePokemon 
    FROM typepokemon T
    LEFT JOIN pokemon P2 ON P2.IdSecondTypePokemon = T.IdType 
    LEFT JOIN pokemon P ON P.IdTypePokemon = T.IdType 
    WHERE P.IdTypePokemon = $Idtype OR P2.IdSecondTypePokemon = $Idtype OR P.IdSecondTypePokemon = $Idtype
    GROUP BY NomPokemon
    ORDER BY P.IdPokemon;";

    $query = $databaseConnection->query($sql);

    if ($query->num_rows>0){
    $typeResult=$query->fetch_assoc();
    $typelibelle=$typeResult['libelleType'];

    $query->data_seek(0);
    // Afficher la liste des Pokémon correspondants
    
        $result = $query->fetch_all(MYSQLI_ASSOC);
        echo "<h2 class=titre>Pokémon de type ".$typelibelle." :</h2>";
        echo "<table class ='tableau_Type_pokemon'>";
        echo "<th class = tableau_t>Numéro</th>
        <th class = tableau_t>Nom</th>
        <th class = tableau_t>Photo</th>";
        foreach ($result as $row) {
            echo "<tr><td class = tableau_all>" . $row["IdPokemon"] . 
            "</td><td class = tableau_all><a href='detailsPokemon.php?id=".$row['IdPokemon']." '>" . $row["NomPokemon"] . 
            "</td><td class = tableau_all><a href='detailsPokemon.php?id=".$row['IdPokemon']." '><img src='" . $row["urlPhoto"] . 
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