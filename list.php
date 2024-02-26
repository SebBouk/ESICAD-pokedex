<!-- 
    Ce fichier représente la page de liste de tous les pokémons.
-->
<?php
require_once("head.php");
?>
<table>
    <thead>
        <th>Numéro</th>
        <th>Nom</th>
        <th>Photo</th>
<?php
require_once("database-connection.php");
$query = $databaseConnection->query("SELECT * from pokemon");

if (!$query) {
    throw new RuntimeException ("Cannot execute query. Cause : " . mysqli_error($connection)); 
} else {
    $pokemons = $query->fetch_all(MYSQLI_ASSOC);
    foreach ($pokemons as $pokemon) {
        echo "<tr><td>" . $pokemon["IdPokemon"] . "</td><td>" . $pokemon["NomPokemon"] . "</td><td><img src='" . $pokemon["urlPhoto"] . "'></td></tr>";
    }
}
?>
    </thead>
</table>

<?php
require_once("footer.php");
?>