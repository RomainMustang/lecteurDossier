<?php

/*  Si on navigue dans les dossiers ou fichiers  */
if(!isset($_GET['path']))
{
	$repertoire = "c:/wamp64/www/";
	$path="";
}

/*  Chargement de la page de démarrage  */
else
{
	$repertoire = "c:/wamp64/www". $_GET['path'];
	$path = $_GET['path'];
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Lecteur de fichiers</title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container-fluid">
	<div class="slide morph slide1">	
		<div class="col-md-offset-3 col-md-5">
			<img src="css/images/acceuil2.png" alt="acceuil">
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-offset-4" id="loca">
			<?php
				echo "Vous êtes dans : accueil" . $path;
			?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-offset-4 col-md-4">
			<div class="col-md-4 col-md-offset-2">
				<a class="aligne" href="?"><img src="css/images/dossier.png">ACCUEIL</a>
			</div>
			<?php
				/*  Aller au dossier parent  */
				$parent = directorieParent($path);
				echo "<div class='col-md-4'>
						<a class='liensHaut aligne' href='?path=$parent'><img src='css/images/dossier.png'>Retour</a>
					  </div>";
			?>
		</div>
	</div>
	<div class="col-md-12">
		<div class="col-md-offset-2 col-md-8">

	<?php

	/*  Vérifie si on est dans un dossier  */
	if(is_dir($repertoire))
	{
		$dossiers = [];
		$fichiers = [];

		/*  Scan tous les document du dossier  */
		$elements = scandir($repertoire);

		foreach ($elements as $element) 
		{
			/*  Vérifie le format du document  */
			if(is_dir($repertoire."/".$element))
			{
				/*  On ajoute tous les dossiers sauf le dossier parent et courant  */
				if($element != ".." && $element != ".")
				{
					$dossiers[] = $element;
				}
			}
			else
			{
				/*  On ajoute tous les fichiers sauf le fichier .htaccess  */
				if($element != ".htaccess")
				{
					$fichiers[] = $element;
				}
			}
		}

		/*  On affiche tous les dossiers du dossier courant  */
		for($i = 0 ; $i < count($dossiers); $i++)
		{
			$tableau = verifFile($dossiers[$i]);
			$chemin =$dossiers[$i];
			echo "<div class='col-md-2'>
						<a class='aligne' href='?path=$path/$chemin'><img src='css/images/dossier.png'>$dossiers[$i]</a>
				  </div>";
		}

		/*  On affiche tous les fichiers du dossier courant  */
		for($i = 0 ; $i < count($fichiers); $i++)
		{
			$tableau = verifFile($fichiers[$i]);
			$extention = $tableau[1];
			$chemin =$fichiers[$i];
			echo "<div class='col-md-2'>
						<a class='aligne' href='?path=$path/$chemin'><img src='css/images/$extention.png'>$fichiers[$i]</a>
				  </div>";	
		}
	}

	/*  Lorque que l'on clic sur un fichier  */
	else
	{
		showFile($repertoire, $path);
	}

	/*  Affiche un fichier  */
	function showFile($file, $path)
	{
		$doc = verifFile($file);
		if($doc[1] == "png" || $doc[1] == "ico"  || $doc[1] == "jpg")
		{
			echo "<img src='$path'>";
		}
		else
		{
			echo "<a href='$path'>télécharger</a> <br>";
			echo htmlentities(highlight_string(file_get_contents($file)));
		}		
	}

	/*  Recherche du dossier parent  */
	function directorieParent($chemin)
	{
		$position = strripos($chemin, "/");

		return substr($chemin, 0, $position - strlen($chemin));
	}

	/*  Cherche le format du document  */
	function verifFile($doc)
	{
		$tableau = [];
		$tableau[0] = strripos($doc, ".");
		$tableau[1] = substr($doc, $tableau[0] + 1);
		return $tableau;
	}

	?>
		</div>
	</div>
</div>

</body>

</html>