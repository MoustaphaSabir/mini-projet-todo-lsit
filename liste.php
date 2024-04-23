<?php
 
// Connexion à la BDD
 
// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$nomBaseDeDonnees = "liste_tache";
 
// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $nomBaseDeDonnees);
 
if (!$connexion) {
    die("Connexion échouée : " . mysqli_connect_error());
}
 
 
// Traitement form listeTaches
if (isset($_POST['listeTaches']) && isset($_POST['liste'])) {
    // print_r($_POST);
    // Retour de $_POST : 12 => on, 5 => on, listeTaches => true
 
    // Mettre les checkbox des taches à non cochées
    $sql = 'UPDATE liste SET fait = 0';
    mysqli_query($connexion, $sql);
 
    // Boucler sur les id provenant du formulaire pour mettre à jour la base
    foreach ($_POST['liste'] as $key => $value) {
        //print_r($_POST);
        $sql = "UPDATE liste SET fait = 1 WHERE id_tache = '$key'";
        mysqli_query($connexion, $sql);
    }
 
}
 
// Traitement form ajoutTache
if (isset($_POST['ajoutTache'])) {
 
    // Récupération du titre de la tache du formulaire
    $titre = $_POST['titre'];
 
    // Enregistrement en BDD de la tache
    $sql = 'INSERT INTO liste (titre, fait) VALUES ("' . $titre . '", 0)';
    echo $sql;
    mysqli_query($connexion, $sql);
}
 
 
 
// HTML : Header
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
</head>
<body>
 
<!-- Affichage du form listeTaches -->
<form action="" method="post">
<?php
    $sql = "SELECT * FROM liste";
    $resultat = mysqli_query($connexion, $sql);
   
    foreach ($resultat as $tache) {
 
        // Mettre checked si la tache en BDD est "fait" = true
        $caseCheck = '';
        if ($tache['fait'] == 1) {
            $caseCheck = 'checked';
        }
        echo '<input type="checkbox" name="liste[' . $tache['id_tache'] . ']" value="' . $liste['id'] . '"  ' . $caseCheck . ' />';
 
       
        echo $liste['titre'] . '<br />';
       
    }
    ?>
<input type="submit" name="listeTaches">
</form>
 
 
<!-- Affichage du form ajoutTache -->
<form action="" method="post">
<input type="text" name="titre">
<input type="submit" name="ajoutTache">
</form>
 
<!-- HTML : Footer -->
</body>
</html>