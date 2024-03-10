<?php
require_once("head.php");
?>

<body>
 <h1>Liste des utilisateurs</h1>
 <table>
 <thead>
 <th>Nom</th>
 <th>Prénom</th>
 <th>Date de naissance</th>
 </thead>
 <tbody>
 <?php
require_once("database-connection.php"); // on indique que l'on veut exécuter le fichier connection.php
 $query = $databaseConnection->query("SELECT * from users"); // on peut récupérer l’objet $connection car il est global

if (!$query) {
// en cas d'erreur, la fonction mysqli_error() indique la cause de l'échec de la requête
throw new RuntimeException ("Cannot execute query. Cause : " . mysqli_error ($databaseConnection ));
} else {
// je récupère le résultat de la requête dans un tableau associatif (aussi appelé un tableau clé => valeur)
 while ($user = $query->fetch_assoc ()){
 echo "<tr><td>" . $user['lastName' ] . "</td><td>" . $user["firstName" ] . "</td><td>" . $user["dateOfBirth" ] . 
"</td></tr>" ;
 }
}
?>
 </tbody>
 </table>
 <a href="add-user.php" >Ajouter un utilisateur </a>
</body>

<?php
require_once("footer.php");
?>