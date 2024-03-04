<!-- 
    Ce fichier représente la page de liste de tous les pokémons.
-->
<?php
require_once("head.php");
?>
<table class = "tableau_pokemon">
    <thead >
        <th class = "tableau_t">Numéro</th>
        <th class = "tableau_t">Nom</th>
        <th class = "tableau_t">Photo</th>
        <th class = "tableau_t">PV</th>
        <th class = "tableau_t">Attaque</th>
        <th class = "tableau_t">Defense</th>
        <th class = "tableau_t">Vitesse</th>
        <th class = "tableau_t">Special</th>
        <th class = "tableau_t">Type 1</th>
        <th class = "tableau_t">Type 2</th>
<?php
require_once("database-connection.php");
$query = $databaseConnection->query("SELECT pokemon.*, type1.libelleType AS premier_type, type2.libelleType AS deuxieme_type
FROM pokemon
LEFT JOIN typepokemon AS type1 ON type1.IdType = pokemon.IdTypePokemon
LEFT JOIN typepokemon AS type2 ON type2.IdType = pokemon.IdSecondTypePokemon
ORDER BY IdPokemon ASC;");

if (!$query) {
    throw new RuntimeException ("Cannot execute query. Cause : " . mysqli_error($connection)); 
} else {
    $pokemons = $query->fetch_all(MYSQLI_ASSOC);
    foreach ($pokemons as $pokemon) {
        echo "<tr><td class = tableau_all>" . $pokemon["IdPokemon"] . "</td><td class = tableau_all>" . $pokemon["NomPokemon"] . "</td><td class = tableau_all><img src='" . $pokemon["urlPhoto"] . "'></td><td class = tableau_all>" . $pokemon["PV"] . "</td><td class = tableau_all>" . $pokemon["Attaque"] . "</td><td class = tableau_all>" . $pokemon["Defense"] . "</td><td class = tableau_all>" . $pokemon["Vitesse"] . "</td><td class = tableau_all>" . $pokemon["Special"] . "</td><td class = tableau_all>" . $pokemon["premier_type"] . "</td><td class = tableau_all>" . $pokemon["deuxieme_type"] . "</td></tr>";
    }
}
?>
    </thead>
</table>

<?php
require_once("footer.php");
?>