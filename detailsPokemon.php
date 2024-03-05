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
    $pokemon = $query->fetch_assoc();
    echo '<h1>'.$pokemon['NomPokemon'].'</h1>';
    echo '<img src="'.$pokemon['urlPhoto'].'">';
    echo '<p>PV : '. $pokemon['PV'].'</p>
    <p>Attaque : '. $pokemon['Attaque'].'</p>
    <p>Defense : '. $pokemon['Defense'].'</p>
    <p>Vitesse : '. $pokemon['Vitesse'].'</p>
    <p>Special : '. $pokemon['Special'].'</p>';

    $queryEvo = $databaseConnection->query("SELECT idEvolution FROM evolutionpokemon WHERE idPokemon = " .$id);
    if($queryEvo){
        $evo=$queryEvo->fetch_assoc();
        if($evo){
            $queryEvoDetails=$databaseConnection->query("SELECT * FROM pokemon WHERE IdPokemon = ".$evo['idEvolution']);
            while($queryEvoDetails){
                $evodetails = $queryEvoDetails->fetch_assoc();
                echo '<h2>Evolution : '. $evodetails['NomPokemon'].'</h2>';
                echo '<img src="'. $evodetails['urlPhoto'].'">
                <p>PV : '. $evodetails['PV'].'</p>
                <p>Attaque : '. $evodetails['Attaque'].'</p>
                <p>Defense : '. $evodetails['Defense'].'</p>
                <p>Vitesse : '. $evodetails['Vitesse'].'</p>
                <p>Special : '. $evodetails['Special'].'</p>';
            }
        }
    }
}
?>

<?php
require_once("footer.php");
?>