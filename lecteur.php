<?php

if(!isset($_GET['path']))
{
	$repertoire = "c:/wamp64/www/";

}
else
{
	$repertoire = $_GET['path'];
}

/*  Fonction permettant d'accèder au dossier www  */
function displayHome($repertoire)
{
	$dossier = scandir($repertoire);

	for($i = 1 ; $i < count($dossier); $i++)
	{
		echo $dossier[$i];

		/*  Vérifie si le dossier est vraiment un dossier  */
		if(is_file($repertoire . $dossier[$i]) == false)
		{
			$chemin = $repertoire . $dossier[$i];
			echo $chemin;
			//echo "<a href='path=$chemin'><img src='css/images/arrow.png'></a><br>";
		}
		else
		{
			echo "c'est un fichier <br> <br>";
		}
	}
}


displayHome($repertoire);

 //  $ma_chaine = 'C:/wamp64/www';
 //  $trouve_moi  = '/';
 //  $position = strripos($ma_chaine, $trouve_moi);

 //  // Vous devez utiliser ===  car == n'affichera rien
 //  // car la lettre 'a' est à la position 0

 //  if ($position === false) {
 //      echo '',$trouve_moi,' n\'a pas été trouvé dans la chaine ',$ma_chaine,'';
 //      } else 
 //      {
 //      echo '',$trouve_moi,' a été trouvée dans la chaîne ',$ma_chaine,'';
 //      echo 'à la position ',$position,'<br>';
 //      }
 // echo substr($ma_chaine, 0, $position - strlen($ma_chaine));

?>

<!DOCTYPE html>
<html>
<head>
	<title>Lecteur de fichiers</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<a href="?path=c:/wamp64/www"><img src="css/images/home.png" alt="HOME"></a> 
</body>
</html>