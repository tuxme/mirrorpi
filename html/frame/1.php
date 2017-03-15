 <head>
    <meta http-equiv="refresh" content="59"> <!-- See the difference? -->
  </head>
    <style type="text/css">
@font-face { font-family: Delicious; src: url('../font.otf'); } @font-face { font-family: Delicious; font-weight: bold; src: url('../font.otf'); }
body {
  font-family: 'Delicious', serif;
  font-size: 48px;
}
</style> </head>

<div align='center'>
<p>
<font color="white">
<?php
try
	{
	include('configfile.conf') ;
	$bdd = new PDO("mysql:host=localhost;dbname=$DBNAME;charset=utf8", "$DBUSER", "$DBPASS");
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$reponse = $bdd->query("SELECT id,phrase FROM helloworld ORDER BY RAND() limit 1 ");

while ($donnees = $reponse->fetch())
{
	print "$donnees[phrase]";
}
$nom_jour_fr = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
$mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", 
        "septembre", "octobre", "novembre", "décembre");
list($nom_jour, $jour, $mois, $annee) = explode('/', date("w/d/n/Y"));
$today=$nom_jour_fr[$nom_jour].' '.$jour.' '.$mois_fr[$mois].' '.$annee; 



print "<br><font size='5'>$today</font>";



?>
</font>
</p>

</div>

