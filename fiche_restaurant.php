<?php include("entete.php"); ?>

<p class="lead">

<?php

$id = $_REQUEST['id'];

$requete = $base->prepare("SELECT
					restaurant.nom AS nom_du_restaurant,
					quartier.nom AS nom_quartier,
					restaurant.description AS description,
					restaurant.adresse FROM restaurant
					JOIN quartier ON quartier.id=id_quartier
					WHERE restaurant.id=:id
					");

$requete->bindValue(':id', $id);

$requete->execute();

$ligne = $requete->fetch();

echo '<h2>';
echo $ligne['nom_du_restaurant'];
echo '<small>';
echo ' (quartier ';
echo $ligne['nom_quartier'];
echo ')';
echo '</small>';
echo '</h2>';

echo '<address>';
echo $ligne['adresse'];
echo '</address>';

echo '<p>';
echo $ligne['description'];
echo '</p>';

$requete = $base->prepare("SELECT cuisinier.nom AS nom_cuisinier,
			diplome.nom AS diplome,
			cuisinier.id AS id_cuisinier,
			restaurant.id FROM cuisinier
			JOIN diplome ON diplome.id=id_diplome
			JOIN restaurant ON restaurant.id=id_restaurant
			WHERE restaurant.id=:id
 ");
$requete->bindValue(':id', $id);

$requete->execute();

echo '<ul>';
while ($ligne = $requete->fetch()) {
	echo '<li><strong>Cuisinier : </strong><a href="fiche_cuisinier.php?id='.$ligne['id_cuisinier'].'"> '. $ligne['nom_cuisinier'] .'
	</a><strong>Diplome : </strong>'.$ligne['diplome'].'</li>';

};
echo '</ul>';

?>
	<div>
	<!--bouton Supprimer-->
	<label for="submit"></label>
	<input type="submit" name="text" value="Supprimer">
	</div>


<?php include("pieddepage.php"); ?>
