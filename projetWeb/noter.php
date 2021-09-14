<?php
    
    session_start();
	
	//Tentative de connection à la BDD
    try
	{
		$bdd = new PDO(
		'mysql:host=localhost;dbname=perezlacoste;charset=utf8',
		'root',
		'',
		array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
		);
	}
		catch (Exception $e)
	{
		die($e->getMessage());
	}
    
	//Enregistrement du commentaire
	//On récupère l'ID de la personne
	$req=$bdd->prepare("SELECT ID_Client FROM clients WHERE Login_Client=:login");
	$req->execute(array("login" => $_SESSION["login"]));
	
    $id=$req->fetch();

    //Viens t-ilde réactualiser la page
    //A t-il déjà laissé un commentaire
		$req=$bdd->prepare("SELECT COUNT(n.ID_Note) AS commentaire FROM notes AS n JOIN clients AS C ON n.ID_Client=c.ID_Client 
        WHERE c.Login_Client=:ID_Client AND n.ID_Produit=:ID_Produit");
        $req->execute(array("ID_Produit" => $_GET["ID"],"ID_Client" => $_SESSION["login"]));

        $commentaire=$req->fetch();

    
	if(isset($_GET["notation"]) && isset($_GET["commentaire"]) && !$commentaire["commentaire"])
	{
		$req = $bdd->prepare("INSERT INTO notes(ID_Note,
		ID_Client, ID_Produit,Valeur_Note,Commentaire_Note) VALUES (NULL, :idClient,
		:id_produit,:valeurNote,:commentaireNote)");

		$req->execute(array(
		"idClient" => $id["ID_Client"],
		"id_produit" => $_GET["ID"],
		"valeurNote" => $_GET["notation"],
		"commentaireNote" => $_GET["commentaire"]
        ));
    }

    
    include "jeu.php";
?>