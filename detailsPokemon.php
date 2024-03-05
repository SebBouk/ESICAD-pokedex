<?php
require_once("head.php");
?>
<?php
require_once("database-connection.php");

$id=$_GET['id'];
$query=$databaseConnection->query("SELECT * FROM pokemon WHERE IdPokemon = ".$id);

if(!$query){
    echo "Erreur SQL : ".$databaseConnection->error;
}else{

    $queryAncetre = $databaseConnection->query("SELECT ep1.*, ep2.idPokemon AS idAncetre
    FROM evolutionpokemon AS ep1
    LEFT JOIN evolutionpokemon AS ep2 ON ep1.idEvolution -2 = ep2.idPokemon 
    WHERE ep1.idPokemon = " .$id);
if($queryAncetre){
    $ancetre=$queryAncetre->fetch_assoc();
    if($ancetre){
        $queryAncetreDetails=$databaseConnection->query("SELECT * FROM pokemon WHERE IdPokemon = ".$ancetre['idAncetre']);
        if($queryAncetreDetails){
            $ancetredetails = $queryAncetreDetails->fetch_assoc();
            echo '<table>';
            echo '<tr><td>';
            echo '<h2>Ancetre : '. $ancetredetails['NomPokemon'].'</h2>';
            echo '<a href="detailsPokemon.php?id='.$ancetredetails['IdPokemon'].'"><img src="'. $ancetredetails['urlPhoto'].'"class=img></a>';
            echo '</td>';
        }
    }
}
    $pokemon = $query->fetch_assoc();
    echo '<td class=tabMid>';
    echo '<h1>'.$pokemon['NomPokemon'].'</h1>';
    echo '<a href="detailsPokemon.php?id='.$pokemon['IdPokemon'].'"><img src="'.$pokemon['urlPhoto'].'"class=img></a>';
    echo '<p>PV : '. $pokemon['PV'].'</p>
    <p>Attaque : '. $pokemon['Attaque'].'</p>
    <p>Defense : '. $pokemon['Defense'].'</p>
    <p>Vitesse : '. $pokemon['Vitesse'].'</p>
    <p>Special : '. $pokemon['Special'].'</p>';
    echo '</td>';

    $queryEvo = $databaseConnection->query("SELECT idEvolution FROM evolutionpokemon WHERE idPokemon = " .$id);
    if($queryEvo){
        $evo=$queryEvo->fetch_assoc();
        if($evo){
            $queryEvoDetails=$databaseConnection->query("SELECT * FROM pokemon WHERE IdPokemon = ".$evo['idEvolution']);
            if($queryEvoDetails){
                $evodetails = $queryEvoDetails->fetch_assoc();
                echo '<td>';
                echo '<h2>Evolution : '. $evodetails['NomPokemon'].'</h2>';
                echo '<a href="detailsPokemon.php?id='.$evodetails['IdPokemon'].'"><img src="'. $evodetails['urlPhoto'].'"class=img></a>';
                echo '</td></tr>';
                echo '</table>';
            }
        }
    }
}
?>

<?php
require_once("footer.php");
?>