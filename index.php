
<?php
    //Paramétres de connection
    $serveur = "localhost";
    $utilisateur = "root";
    $mot_de_passe = "";
    $base_de_donnees = "liste_tache";

    // Établir la connexion
    $connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

    // Vérifier la connexion
    if (!$connexion) {
        die("Échec de la connexion : " . mysqli_connect_error());
    }

    // Traiter les données du formulaire pour ajouter une nouvelle tâche

    if ($_POST["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST['ajouttache'])) {
            $nouvelle_tache = $_POST['ajouttache'];
            // Insérer la nouvelle tâche dans la base de données
            $sql = "INSERT INTO liste (nom_tache) VALUES ('$nouvelle_tache')";
            // echo $sql;
            mysqli_query($connexion, $sql);
        }
    }

    // Récupérer les tâches depuis la base de données
    
    $sql = "SELECT * FROM liste ORDER BY id_tache DESC";

    // Vérifier si la requête a réussi
    // echo "<ul>";
    //     if ($listes) {
    //         // print_r($cours);
    //         foreach($listes as $liste) {
    //             echo '<input type="checkbox" name=" '. $liste['nom_tache'] .'"  id="id_tache">';

    //             echo $liste['nom_tache'] . " : " . $liste['description_taches'] . "<br>";
    //         }
    //     } else {
    //         echo "Erreur : " . mysqli_error($connexion);
    //     }
    $resultat = mysqli_query($connexion, $sql);

?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des tâches</title>
</head>
<body>
    <h1>TODO-LIST</h1>
    <form action="" method="post">

    <?php
    foreach ($resultat as $row) {
        echo '<input type="checkbox" name="' . $row['nom_tache'] . '">';
        echo $row['nom_tache'] . "<br>";
    }
    ?>  <br>
     
        <button type="submit" name = "formulaireTache">Enregistrer</button>
    </form>

    <h2>Liste des tâches enregistrées</h2> 
    <ul>
        <?php
            // Afficher les tâches cochées
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                foreach ($_POST as $nom_tache => $valeur) {
                    echo "<li>$nom_tache</li>";
                }
            }
        ?>
    </ul>

    <h2>Ajouter une nouvelle tâche</h2>
    <form action="" method="post">
        <label for="ajouttache">Nouvelle tâche:</label>
        <input type="text" id="ajouttache" name="ajouttache">
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

