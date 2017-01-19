<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <title>Explorateur</title>
</head>
<body>
<div class="tous">
    <div class="contenu">
        <div class="div1">
            <div class="fleche">
                    <a  src="240_F_18101134_zVd7Mlj23v2OXmHmcEHjgxxq3gyhtdXj.png" href="javascript:history.go(-1)"><img src="240_F_18101134_zVd7Mlj23v2OXmHmcEHjgxxq3gyhtdXj.png" class="retour"></a>
       <a  href="javascript:history.go(+1)"><img src="2.png" class="suivant">;</a> 
            </div>
        <p class="d1"><i class="fa fa-folder" aria-hidden="true"></i>&#8239 Explorateur de fichier</p>
        <form action="#">
        <input type="text" name="rechercher" placeholder="Recherche..." class="rechercher">
</form>
        </div>
<div class="div2">

<?php
    echo '<fieldset><legend><i class="fa fa-folder-open" aria-hidden="true"></i>Liste des fichiers</legend><br>'; 

	$url = "http://localhost/gestion"; //On stock l'url dans une variable pour l'utiliser plus tard

	$slash = "\\"; //On stock le slash dans une variable pour changer rapidement entre / et \ si on change de serveur

	$chemin = realpath("voir_fichiers.php"); // Récupère le chemin réel sur le serveur d'index.php
	$chemin = str_replace("voir_fichiers.php", "", $chemin); //On enlève "index.php" du chemin réel pour obtenir le chemin réel de notre dossier de projet (chez moi c:\wamp64\www\explorateur\)
           
            echo $chemin;
    
	$cheminDeBase = $chemin; //Pour l'instant, le chemin ne dépend pas de la variable $_GET, c'est le chemin de base du projet, je le stock dans une variable avant de faire d'autres modifications
	
	
	if(isset($_GET['chemin']) && !empty($_GET["chemin"])) { // Si on a des infos dans $_GET['chemin']

		$chemin = $chemin.$_GET['chemin'].$slash; //On les rajoute au chemin, ici $chemin vaut par exemple C:\wamp64\www\explorateur\fichiers\ControlCenter4\

		$chemin = str_replace($slash.$slash, $slash, $chemin); //J'ai eu des soucis de double slash, donc si j'ai un double slash je le remplace par un seul. C'est un peu sale, j'aurais du rechercher pourquoi j'avais des doubles plutôt que cette méthode bourrine, mais bon...
	}

	if(strpos($chemin, "..") != false) {
		echo $chemin."<br>";  
		die ("Forbidden chemin");
	} //On interdit les .. dans le chemin pour éviter que quelqu'un puisse remonter dans mes dossiers hors du projet
	
	
	$cheminAEnvoyer = str_replace($cheminDeBase, "", $chemin); //J'enlève le chemin de base du chemin complet pour envoyer que la partie qui nous intéresse (envoyer par exemple fichiers\ControlCenter4\ au lieu de C:\wamp64\www\explorateur\fichiers\ControlCenter4\) . L'URL sera plus propre et ça évite de donner des infos sur la structure de mon serveur (sécurité)
	

	if(is_dir($chemin)) {
		$dir = scandir($chemin);
	}
	else {
		die("Erreur : Le chemin demandé n'est pas un dossier");
	} //Si le chemin complet correspond bien à un dossier, on le scan et $dir contiendra un tableau avec tous nos fichiers
	
	foreach ($dir as $key => $fichier) : //On boucle sur le tableau renvoyé par scandir()
	
		if($fichier != "." && $fichier != ".." && $fichier != "voir_fichiers.php") { //On ne veut pas afficher les dossier . et .. ni ce fichier index.php

			if(is_dir($chemin.$fichier)) { //Si c'est un dossier
		
				echo  "<i class='fa fa-folder-open' aria-hidden='true'></i>Dossier : <a href='".$url."/voir_fichiers.php?chemin=".$cheminAEnvoyer.$fichier."'>".$fichier."	</a><br>"; //On affiche le nom du dossier avec un lien pour envoyer le chemin du dossier en $_GET
			}

			else if(is_file($chemin.$fichier)) { //Si c'est un fichier


				echo "<i class='fa fa-file' aria-hidden='true'></i>Fichier :  <a target='_blank' href='".$url.$slash.$cheminAEnvoyer.$fichier."'>".$fichier."	</a><br>";
				//On affiche le nom du fichier avec un lien direct vers le fichier, en utilisant l'URL et pas le chemin réel (pas de passage en $_GET). On met target="_blank" pour l'ouvrir dans un nouvel onglet
				
			}
			else {
				echo "Type inconnu<br>"; //Si ce n'est ni un fichier ni un dossier. N'est pas censé arriver

			}
	
		}
	endforeach;
	
	?> 

</div>
</div>    
</div>
</body> 
</html> 