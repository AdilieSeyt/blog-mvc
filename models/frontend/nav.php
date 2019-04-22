<?php
	require_once('././models/dbconnect.php');

    function nav(){
		$db = dbConnect();

	//récupération de la liste des catégories pour générer le menu
	$query = $db->prepare('SELECT  name, id FROM category ');
	$query->execute();
    return $categoriesList = $query->fetchAll();
}