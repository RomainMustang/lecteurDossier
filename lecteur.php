<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Explorateur de fichiers</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Explorateur de fichiers</h1>

</body>
</html>

<?php
// choix du répertoire et ouverture
$dir = '../';
var_dump(scandir($dir));
$files = opendir($dir);
// Boucle pour lire le répertoire ligne par ligne
while($element = readdir($files)) {
    if (is_dir($dir.$element))
        $dossier[] = $element;
    else
        $fichier[] = $element;
}
// Tri des éléments et réindexation du tableau selon le nouvel ordre
natsort($dossier);
$dossier = array_values($dossier);
natsort($fichier);
$fichier = array_values($fichier);

//$liste = array_values($liste); // range par ordre alphabetique ... ou pas
// Comptage du nombre d'éléments
$liste = array_merge($dossier, $fichier);
$nombre = count($liste);
?>

<?php
// Boucle pour lire et afficher les répertoires

for ($i=0; $i<$nombre; $i++) {
	if ($liste[$i] != "." && $liste[$i] != "..")
    {
	
		if (is_dir($dir.$liste[$i])) echo $liste[$i].' est un dossier <br>';
		else echo $liste[$i].' est un fichier <br>';
		
    } 
}

?>