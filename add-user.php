<form action="add-user.php" method="POST">
 <div class="input-field">
 <label for="firstname">Votre prénom : </label>
 <input
 id="firstname"
 type="text"
 name="firstname"
 placeholder="Saisir votre prénom..."
 />
 </div>
 <div class="input-field">
 <label for="lastname">Votre nom : </label>
 <input
 id="lastname"
 type="text"
 name="lastname"
 placeholder="Saisir votre nom..."
 />
 </div>
 <div class="input-field">
 <label for="dob">Votre date de naissance : </label>
 <input
 id="dob"
 type="date"
 name="dob"
 placeholder="Saisir votre date de naissance..."
 />
 <div class="input-field">
 <label for="login">Votre login : </label>
 <input
 id="login"
 type="text"
 name="login"
 placeholder="Saisir votre login..."
 />
 <div class="input-field">
 <label for="password">Votre mot de passe : </label>
 <input
 id="password"
 type="password"
 name="password"
 placeholder="Saisir votre mot de passe..."
 />
 </div>
 <button type="submit">Ajouter</button>
 </form>


<?php
require_once("database-connection.php");

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs requis sont remplis
    if (isset($_POST["firstname"], $_POST["lastname"], $_POST["dob"], $_POST["login"], $_POST["password"])) {
        // Récupérer les données du formulaire
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $dateOfBirth = $_POST["dob"];
        $login = $_POST["login"];
        $password = $_POST["password"];
        $hashedPassword = md5($password);

        // Insérer les données dans la base de données
        $query = "INSERT INTO users (firstname, lastname, dateOfBirth, login, password)
                  VALUES ('$firstname', '$lastname', '$dateOfBirth', '$login', '$hashedPassword')";
        if ($databaseConnection->query($query) === TRUE) {
            header("location: user.php");
            exit(); // Arrêter l'exécution du script après la redirection
        } else {
            echo "Erreur lors de l'insertion : " . $databaseConnection->error;
        }
    } else {
        echo "Tous les champs sont requis.";
    }
}
?>