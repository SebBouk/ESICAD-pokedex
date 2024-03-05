<!-- 
    Ce fichier représente la page de résultats de recherche de pokémons du site.
-->
<?php
require_once("head.php");
?>

<?php
require_once("database-connection.php");

if (isset($_GET['q'])){
    $nom = $_GET['q'];

    $query = $databaseConnection->query("SELECT * FROM pokemon WHERE NomPokemon LIKE '".$nom."%'");

    if(!$query){
        echo "Erreur SQL : " .$databaseConnection->error;
    } else {
        echo '<table>';
        while ($pokemon = $query->fetch_assoc()){
            echo '<tr>';
            echo '<td><a href="detailsPokemon.php?id='.$pokemon['IdPokemon'].'"><img src="'.$pokemon['urlPhoto'].'"></a><td>';
            echo '<td><a href="detailsPokemon.php?id='.$pokemon['IdPokemon'].'">'.$pokemon['NomPokemon'].'</a><td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}else{
    echo"Aucun Nom fourni.";
}
require_once("footer.php");
?>