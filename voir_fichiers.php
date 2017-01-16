<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Explorateur</title>
</head>
<body>
<div class="tous">
<div class="contenu">
<div class="div1">
<div class="fleche"> 
<input type="image" src="240_F_18101134_zVd7Mlj23v2OXmHmcEHjgxxq3gyhtdXj.png" name="retour "class="retour">
<input type="image" src="2.png" name="suivant "class="suivant">
</div>
<p class="d1">Explorateur de fichier</p>
<form action="#">
<input type="text" name="rechercher" placeholder="Recherche..." class="rechercher">
</form>
</div>
<div class="div2">
<?php

$adresse = "./fichier/"; //Adresse du dossier.
if(isset($_GET['nom'])) //Si $_GET['nom'] existe, on supprime le fichier...
{
     if ($Fichier != "." && $Fichier != "..")
     {
          $nom=''.$adresse.$_GET['nom'].'';
          unlink($nom);
          echo 'Le fichier "'.$_GET['nom'].'" a été éffacé !<br>';
     }
}
$dossier = opendir($adresse); //Ouverture du dossier.
echo '<fieldset><legend>Liste des fichiers</legend><br>'; //Ouverture de fieldset
//(Fieldset permet de faire des cadres avec légende intégrée en haut a gauche.
//C'est très simple à utiliser et ça permet de répartir les formulaires en plusieurs parties et donc d'accroître leur lisibilité !).
while ($Fichier = readdir($dossier)) //Affichage...
{
     if ($Fichier != "." && $Fichier != "..")
     {
          echo '<a href="voir_fichiers.php?nom='.$Fichier.'">Supprimer</a> => <a href='.$adresse.$Fichier.' target="_blank">'.$Fichier.'</a><BR>';
     }
}
closedir($dossier); //Fermeture du dossier.
echo '<br></fieldset>'; //Fermeture du fieldset.
?> 
</div>
</div>    
</div>
</body> 
</html> 