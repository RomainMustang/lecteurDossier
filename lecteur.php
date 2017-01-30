<?php

/*  Si on a cliquer sur un lien ou pas  */
if(!isset($_GET['path']))
{
	$repertoire = "c:/wamp64/www/";
	$path="";
}

else
{
	$repertoire = "c:/wamp64/www/". $_GET['path'];
	$path = $_GET['path'];
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Lecteur de fichiers</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="col-md-12">
		<div class="col-md-offset-5">
			<a class="aligne liensHaut" href="?">ACCEUIL</a>
			<?php
				$parent = reportorieParent($path, "/");
				echo "<a class='aligne liensHaut' href='?path=$parent'>Dossier parent</a>";
			?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-offset-2 col-md-8">

<?php

/*  Si on a cliquer sur un lien ou pas  */
if(!isset($_GET['path']))
{
	$repertoire = "c:/wamp64/www/";
	$path="";
}

else
{
	$repertoire = "c:/wamp64/www/". $_GET['path'];
	$path = $_GET['path'];
}

/*  Fonction permettant d'accèder au dossier www  */
function displayHome($repertoire, $path)
{
	if(is_dir($repertoire))
	{
		$dossier = scandir($repertoire);

		for($i = 2 ; $i < count($dossier); $i++)
		{

			/*  Le fichier est un dossier  */
			if(is_file($repertoire . $dossier[$i]) == false)
			{
				$chemin =$dossier[$i];
				echo "<a class='aligne' href='?path=$path/$chemin'>$dossier[$i]<img src='css/images/dossier.png'></a>";
			}

			/*  Le fichier n'est pas un dossier  */
			else
			{
				$chemin =$dossier[$i];
				echo "<a class='aligne' href='?path=$path/$chemin'>$dossier[$i]<img src='css/images/fichier.png'></a>";
			}
		}
	}
}

function reportorieParent($chemin, $chercher)
{
  $position = strripos($chemin, $chercher);

 return substr($chemin, 0, $position - strlen($chemin));
}

displayHome($repertoire, $path);


?>
		</div>
	</div>

</body>

</html>